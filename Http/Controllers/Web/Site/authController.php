<?php
namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\googleplusController;

class authController extends Controller
{
    public function register(Request $request){
        
        if(session()->has('registerRomanCode') and session()->has('registerRomanUse') and ( session()->has('registerRomanMobile') or session()->has('registerRomanEmail') )){
            if($request->btn != 'cancel'){
                if(session()->get('registerRomanUse')>=1){
                    session()->put('registerRomanUse', (session()->get('registerRomanUse') - 1));
                    $validator = Validator::make($request->all(), [
                        'code' => 'required',
                        'name' => 'required|string|min:4|max:200|',
                        'password' => 'required|string|min:4|max:100|confirmed',
                        'password_confirmation' =>'required',
                    ],
                    [
                        'password_confirmation.required' => 'لطفا تکرار رمز عبور خود را وارد کنید',
                        'password.confirmed' => 'تکرار رمز عبور با رمز عبور یکسان نیست',
                        'password.max' => 'طول رمز عبور باید کمتر از 100 کاراکتر باشد',
                        'password.min' => 'طول رمز عبور باید بیشتر از 4 کاراکتر باشد',
                        'password.required' => 'لطفا رمز عبور خود را وارد کنید',
                        'name.max' => 'طول نام و نام خانوادگی باید کمتر از 200 کاراکتر باشد',
                        'name.min' => 'طول نام و نام خانوادگی باید بیشتر از 4 کاراکتر باشد',
                        'name.required' => 'لطفا نام و نام خانوادگی خود را وارد کنید',
                        'code.required' => 'لطفا کد تایید خود را وارد کنید',
                    ]);
            
                    if(count($validator->messages()) != 0){
                       session()->put('pmError',$validator->errors()->first());
                       return redirect()->route('register');
                    }elseif(!Hash::check($request->code,session()->get('registerRomanCode'))){
                        session()->put('pmError','کد تایید شما اشتباه است');
                        return redirect()->route('register');
                    }else{
                        
                        if(session()->has('registerRomanMobile')){
                            $mobile = session()->get('registerRomanMobile');
                            $status_mobile = 'active';
                            $count = DB::table('users')->where('mobile',$mobile)->count();
                            if($count != 0){
                                session()->put('pmError','این کاربر در سیستم وجود دارد');
                                return redirect()->route('register');
                            }
                
                        }else{
                            $mobile = null;
                            $status_mobile = 'deactive';
                        }
                        
                        if(session()->has('registerRomanEmail')){
                            $email = session()->get('registerRomanEmail');
                            $status_email = 'active';
                            $count = DB::table('users')->where('email',$email)->count();
                            if($count != 0){
                                session()->put('pmError','این کاربر در سیستم وجود دارد');
                                return redirect()->route('register');
                            }
                        }else{
                            $email = null;
                            $status_email = 'deactive';
                        }

                        DB::table('users')->insert([
                            'name'=> $request->name,
                            'mobile'=> $mobile,
                            'email'=> $email,
                            'password'=> Hash::make($request->password),
                            'avatar' => null,
                            'ip' => request()->ip(),
                            'favourite' => null,
                            'percent' => null,
                            'bank_name' => null,
                            'bank_shaba' => null,
                            'updated_at' => date("Y-m-d H:i:s"),
                            'created_at' => date("Y-m-d H:i:s"),
                            'remember_token' => null,
                            'remember' => null,
                            'status_mobile' => $status_mobile,
                            'status_email' => $status_email,
                            'status' => 'active',
                        ]);
                        session()->forget('registerRomanCode');
                        session()->forget('registerRomanUse');
                        session()->forget('registerRomanMobile');
                        session()->forget('registerRomanEmail');
                        session()->put('pmSuccess','ثبت نام شما با موفقیت انجام شد');
                        session()->put('pmInfo','لطفا وارد شوید');
                        return redirect()->route('login');
                    }
                }else{
                    session()->put('pmError','کد تایید ارسال شده شما منقضی شد');
                }
            }else{
                session()->put('pmSuccess','شما از ادامه ثبت نام انصراف دادید');
            }
            session()->forget('registerRomanCode');
            session()->forget('registerRomanUse');
            session()->forget('registerRomanMobile');
            session()->forget('registerRomanEmail');
            return redirect()->route('register');
        }else{
            if(preg_match('/09\d{9}/', $request->username)){
                $count = DB::table('users')->where('mobile',$request->username)->count();
                if($count != 0){
                    session()->put('pmError','این کاربر در سیستم وجود دارد');
                    return redirect()->route('register');
                }
                $type = 'mobile';
            }elseif(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
                $count = DB::table('users')->where('email',$request->username)->count();
                if($count != 0){
                    session()->put('pmError','این کاربر در سیستم وجود دارد');
                    return redirect()->route('register');
                }
                $type = 'email';
            }else{
                session()->put('pmError','لطفا شماره همراه و یا پست الکترونیکی خود را وارد کنید');
                return redirect()->route('register');
            }
            $code = rand(100000,999999);
            if($type == 'mobile'){
                session()->put('registerRomanMobile',$request->username);
                $sms = new SmsController;
                $sms->send([$request->username],['code'=>$code],'kg5y68vtoa');
            }else{
                
                session()->put('registerRomanEmail',$request->username);
                $mail = new MailController;
                $mail->send('کد تایید ثبت نام رمان خوان',
                            $request->username,
                            'بسیار خوشحالیم که با شما آشنا شدیم',
                            'کد تایید : '.$code);
            }
            session()->put('registerRomanCode',Hash::make($code));
            session()->put('registerRomanUse',5);
            return redirect()->route('register');
        }
    }
    
    
    public function forget_code(Request $request){

        $users = DB::table('users')->where('mobile',$request->username)->first();
        $type = 'mobile';
        if(count($users) == 0){
            $users = null;
            $type = 'email';
            $users = DB::table('users')->where('email',$request->username)->first();
        }

        if(count($users) == 1){
            $forget_decode = json_decode($users->remember);
            
            if($forget_decode != null and (strtotime($forget_decode->date) + 3600 * 24) > time() and $forget_decode->used == 0){
                $data['status'] = false;
                $data['message'] = 'این حساب کاربری قفل شد !! لطفا 24 ساعت دیگر مراجعه کنید';
            }elseif($forget_decode != null and (strtotime($forget_decode->date) + 3600) > time()){
                $data['status'] = true;
                $data['message'] = 'از کد تایید ارسال شده قبلی استفاده کنید';
            }else{
                $code = rand(1000,9999);
                if($type == 'mobile'){
                    $sms = new SmsController;
                    $mail = new MailController;
                    $sms->send([$users->mobile],['code'=>$code],'kg5y68vtoa');
                    $data['message'] = 'کد تایید به شماره تلفن شما ارسال شد';
                }else{
                    

                    $mail = new MailController;
                    $mail->send('کد تایید فراموشی رمز عبور',
                                $users->email,
                                $users->name.' عزیز',
                                'کد تایید شما : '.$code);
                    $data['message'] = 'کد تایید به پست الکترونیکی شما ارسال شد';
                }
                $forget['code'] = $code;
                $forget['used'] = 5;
                $forget['date'] = date("Y-m-d H:i:s");
                DB::table('users')->where('id',$users->id)->update([
                    'remember' =>  json_encode($forget)
                ]);
                $data['status'] = true;
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'کاربری پیدا نشد !!';
        }
        return $data;
    }
    
    public function forget_change(Request $request){
        $users = DB::table('users')->where('mobile',$request->username)->first();
        $type = 'mobile';
        if(count($users) == 0){
        $users = null;
        $type = 'email';
        $users = DB::table('users')->where('email',$request->username)->first();
        }
        if(count($users) == 1){
            $forget_decode = json_decode($users->remember);
            if((strtotime($forget_decode->date) + 3600 * 24) > time() and $forget_decode->used == 0){
                $data['status'] = false;
                $data['message'] = 'این حساب کاربری قفل شد !! لطفا 24 ساعت دیگر مراجعه کنید';
                return $data;
            }
            
            if($request->password==null and $request->password_repeat==null){
                $data['status'] = false;
                $data['message'] = 'رمز عبور وارد کنید';
                return $data;
            }
            
            if($request->password != $request->password_repeat){
                $data['status'] = false;
                $data['message'] = 'رمز عبور یکسان نیست';
                return $data;
            }
            
            $forget_update = json_decode($users->remember,true);
            $forget_update['used'] -= 1;
            DB::table('users')->where('id',$users->id)->update([
                    'remember' => json_encode($forget_update),
            ]);
                
            if($request->code == $forget_decode->code){
                DB::table('users')->where('id',$users->id)->update([
                    'password' => Hash::make($request->password),
                    'status_mobile' => 'active',
                    'remember' => null,
                ]);
                $data['status'] = true;
                $data['message'] = 'رمز عبور شما با موفقیت تغییر یافت';
            }else{
                
                $data['status'] = false;
                $data['message'] = 'کد تایید اشتباه است';
            }
            
        }else{
            $data['status'] = false;
            $data['message'] = 'کاربری پیدا نشد !!';
        }
        return $data;
    }
    
    public function google_request($method, $url, $header, $data){
            if( $method == 1 ){
                $method_type = 1; // 1 = POST
            }else{
                $method_type = 0; // 0 = GET
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            if( $header !== 0 ){
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            }
            curl_setopt($curl, CURLOPT_POST, $method_type);
            if( $data !== 0 ){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            $response = curl_exec($curl);
            $json = json_decode($response, true);
            curl_close($curl);
            return $json;
    }
    
    public function register_google_post2(){
        $config['consumer_key'] = '905529749651-jbdqbgsbeahpahk2q3v2t5vl6faihjk5.apps.googleusercontent.com';
        $config['consumer_secret']   = 'MSWxgG09PF0S127w67c1zIC_';
        $config['callbackUrl']  = 'https://romankhan.com/auth/register_google';
        $GooglePlus = new googleplusController($config);
        header('Location: ' . $GooglePlus->getAuthorizationUrl() );
    }
    
    public function register_google2(){
        $config['consumer_key'] = '905529749651-jbdqbgsbeahpahk2q3v2t5vl6faihjk5.apps.googleusercontent.com';
        $config['consumer_secret']   = 'MSWxgG09PF0S127w67c1zIC_';
        $config['callbackUrl']  = 'https://romankhan.com/auth/register_google';
        $GooglePlus = new googleplusController($config);
        $accessToken = $GooglePlus->getAccessToken($_GET['code']);
		$GooglePlus->setOAuthToken($accessToken->access_token, false);
		$profile = $GooglePlus->getMyProfile();
        $activities = $GooglePlus->getMyActivities();
// 	    $search_results = $GooglePlus->searchPeople($_GET['search'], $search_pagetoken);
// 	    $activities = $GooglePlus->getPublicActivities($profile_id);
	
	   var_dump($profile);
        
    }
    
    public function register_google(){
        
        /******** config *************/
        $scope = "https://www.googleapis.com/auth/userinfo.email"; // Do not change it!
        $redirect_uri = "https://romankhan.com/auth/register_google"; // Enter your redirect_uri
        $client_id = "905529749651-jbdqbgsbeahpahk2q3v2t5vl6faihjk5.apps.googleusercontent.com"; // Enter your client_id
        $login_url = "https://accounts.google.com/o/oauth2/v2/auth?scope=$scope&response_type=code&redirect_uri=$redirect_uri&client_id=$client_id"; // Do not change it!
        
        $client_secret = "MSWxgG09PF0S127w67c1zIC_"; // Enter your client_secret
        $image_size = 100; // Change user profile image size: 100 = 100x100
        
        $header = array( "Content-Type: application/x-www-form-urlencoded" );
        $data = http_build_query(
            array(
            'code' => str_replace("#", null, $_GET['code']),
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code'
            )
        );
        $url = "https://www.googleapis.com/oauth2/v4/token";
        $result = $this->google_request(1, $url, $header, $data);
        
        if( !empty($result['error']) ){ // If error login
            return $result['error'];
        }else{
            $access_token = $result['access_token']; // Access Token
            
            $api_url = "https://www.googleapis.com/plus/v1/people/me?access_token=$access_token"; // Do not change it!
            $user_info = $this->google_request(0, $api_url, 0, 0);
            
            return [
                'access_token' =>$access_token,
                'api_url' => $api_url ,
                'user_info' => $user_info,
            ];
        }
    }
    
    public function register_google_post(Request $request){
        $access_token = 'ya29.a0Ae4lvC1nPOPxFgFmZxge6FM1I64SmHTEOVvlLFZ6j-mQWvB0SJNu9Q6MwnQX4gk2vQ9ilTTYfCK45niYg0ImYw6dXf_yf8XVh73NmYLvjwtHy1BJn7whse8JhHUE1BrtK523xku4_eic-yqMEAmH5UY0aLcRNnbjx_Q';

            $api_url = "https://www.googleapis.com/plus/v1/people/me?fields=aboutMe%2Cemails%2Cimage%2Cname&access_token=$access_token"; // Do not change it!
            $user_info = $this->google_request(0, $api_url, 0, 0);
            // $first_name = $user_info['name']['givenName']; // User first name
            // $last_name = $user_info['name']['familyName']; // User last name
            // $email = $user_info['emails'][0]['value']; // User email
            // $get_profile_image = $user_info['image']['url'];
            // $change_image_size = str_replace("?sz=50", "?sz=$image_size", $get_profile_image);
            // $profile_image_link = $change_image_size; // User profile image link
            // $page_title = "Hello my name is $first_name $last_name!"; // Page title if user is logged in
            
            
            return [
                'access_token' =>$access_token,
                'api_url' => $api_url ,
                'user_info' => $user_info,
            ];
       
    }
}