<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Functions\Date;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ZipArchiverController;
use Illuminate\Http\Request;
use App\Functions\Site;
use Validator;
use App\Functions\functionMe;
use File;

class authorController extends Controller
{
    
    public function dashboard(){
        $Functions_Date = new Date();
        
        $Functions = new Site();
        $Functions->view_users_reset(auth::user()->id);
        
        $book = DB::table('book')->where('status', 'active')->where('id_users', auth::user()->id)->get(['id']);
  
        $comment =  DB::table('comment_book')->
                        whereIn('comment_book.id_book', json_decode($book,true))->
                        join('users', 'users.id', 'comment_book.id_users')->
                        take(5)->
                        get(['users.id AS users_id','users.name AS users_name','users.avatar AS users_avatar','comment_book.context']);

        $follower =  DB::table('follower')->
                        where('follower.following', auth::user()->id)->
                        join('users', 'users.id', 'follower.id_users')->
                        take(5)->
                        get(['users.id AS users_id','users.name AS users_name','users.avatar AS users_avatar']);
        $follower_count = DB::table('follower')->where('following', auth::user()->id)->count();
        $view = json_decode(auth::user()->view,true);
        $view_month = json_decode(auth::user()->view,true)[$Functions_Date->jdate("Y",time(), null , null , 'en')][$Functions_Date->jdate("n",time(), null , null , 'en')];
        $book_count = DB::table('book')->where('status', 'active')->where('id_users', auth::user()->id)->count();
        $view_count = DB::table('book')->where('status', 'active')->where('id_users', auth::user()->id)->sum('view');

        return view('panel.author.dashboard', ['follower'=>$follower, 'comment'=>$comment, 'follower_count'=>$follower_count, 'view'=>$view, 'view_month'=>$view_month, 'book_count'=>$book_count, 'view_count'=>$view_count]);
    }
    
    public function income(){
        $book = DB::table('book')->where('status', 'active')->where('id_users', auth::user()->id)->get(['id']);
        $financial =  DB::table('financial')->
                        where('financial.type', 'book')->
                        where('financial.status', 'paid')->
                        whereIn('financial.value', json_decode($book,true))->
                        get();
                        
        $chart =  DB::table('financial')->where('financial.type', 'book')->whereIn('financial.value', json_decode($book,true))->get(['date']);
                        
        $income_all =  DB::table('financial')->
                        where('financial.type', 'book')->
                        where('financial.status', 'paid')->
                        whereIn('financial.value', json_decode($book,true))->
                        sum('price_author');
                        
        $income_paid =  DB::table('financial')->
                        where('financial.type', 'book')->
                        where('financial.status', 'paid')->
                        where('financial.status_author', 'paid')->
                        whereIn('financial.value', json_decode($book,true))->
                        sum('price_author');
                        
        $income_balance =  DB::table('financial')->
                        where('financial.type', 'book')->
                        where('financial.status', 'paid')->
                        where('financial.status_author', 'balance')->
                        whereIn('financial.value', json_decode($book,true))->
                        sum('price_author');
                        
        $income_unpaid =  DB::table('financial')->
                        where('financial.type', 'book')->
                        where('financial.status', 'paid')->
                        where('financial.status_author', 'unpaid')->
                        whereIn('financial.value', json_decode($book,true))->
                        sum('price_author');

        return view('panel.author.income',['financial'=>$financial,'chart'=>$chart,'income_all_count'=>$income_all,'income_paid_count'=>$income_paid,'income_balance_count'=>$income_balance,'income_unpaid_count'=>$income_unpaid]);
    }
    
    public function bank(Request $request){
        if($request->bank_shaba == null and $request->bank_name == null){
            DB::table('users')->where('id',Auth::user()->id)->update([
                'bank_name'=> null,
                'bank_shaba'=> null,
            ]);
            session()->put('pmSuccess','اطلاعات بانک شما حذف شد');
        }else{
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required',
                'bank_shaba' => 'required|digits:24',
            ],
            [
                'bank_name.required' => 'لطفا نام و نام خانوادگی صاحب حساب را وارد کنید',
                'bank_shaba.required' => 'لطفا شماره شبا حساب را وارد کنید',
                'bank_shaba.digits' => 'شماره شبا باید عدد 24 رقمی باشد',
            ]);
    
            if(count($validator->messages()) != 0){
               session()->put('pmError',$validator->errors()->first());
            }else{
                DB::table('users')->where('id',Auth::user()->id)->update([
                    'bank_name'=> $request->bank_name,
                    'bank_shaba'=> $request->bank_shaba,
                ]);
                session()->put('pmSuccess','اطلاعات بانک شما ثبت شد');
            }
        }
        return redirect()->route('panel.author.income');
    }

    public function balance(Request $request){
        $book = DB::table('book')->where('status', 'active')->where('id_users', auth::user()->id)->get(['id']);
        $income_unpaid =  DB::table('financial')->where('type', 'book')->where('status', 'paid')->where('status_author', 'unpaid')->whereIn('value', json_decode($book,true))->sum('price_author');
        $max = 50000;
        if(Auth::user()->bank_name != null and Auth::user()->bank_shaba != null){
            if($income_unpaid >= $max){
                $time  = time();;
                $financial = DB::table('financial')->where('type', 'book')->where('status', 'paid')->where('date_paid', '<=' , date("Y-m-d H:i:s",$time))->where('status_author', 'unpaid')->get(['authority']);
                foreach($financial as $rows){
                    $authority[] = $rows->authority;
                }
                DB::table('financial')->where('type', 'book')->where('status', 'paid')->where('date_paid', '<=' , date("Y-m-d H:i:s",$time))->where('status_author', 'unpaid')->update([
                    'status_author'=> 'balance'
                ]);
                DB::table('balance')->insert([
                    'id_users' => Auth::user()->id,
                    'price' => $income_unpaid,
                    'name' => Auth::user()->bank_name,
                    'shaba' => Auth::user()->bank_shaba,
                    'date' =>  date("Y-m-d H:i:s",$time),
                    'authority' => null,
                    'financial' => json_encode($authority),
                    'status' => 'unpaid',
                ]);
                session()->put('pmSuccess','تمام مبلغ کیف پول شما تا به الان در صف واریز قرار گرفت');
            }else{
                session()->put('pmError','مبلغ کیف پول شما باید بیشتر از '.number_format($max).' تومان باشد');
            }
        }else{
            session()->put('pmError','لطفا نام حساب و شماره حساب بانک خود را وارد کنید');
        }
        return redirect()->route('panel.author.income');
    }
        
    public function create(){
        return view('panel.author.create');
    }
    
    public function create_pay($id){
        $pay = new PayController();
        if($id==1){
            $price=10000;
            $value = "no-cover";
        }elseif($id==2){
            $price=20000;
            $value = "simple-cover";
        }elseif($id==3){
            $price=30000;
            $value = "professional-cover";
        }else{
            abort(404);
        }
        $id_financial = DB::table('financial')->insertGetId([
                                'id_users' => Auth::user()->id,
                                'type' => 'author',
                                'value' => $value,
                                'price' => $price,
                                'date' =>  date("Y-m-d H:i:s"),
                                'status' => 'unpaid',
                            ]);
        $pay->send( $price ,'pep', $id_financial , route('panel.author.create_verify') , 'خرید بسته انتشار کتاب' , auth::user()->email , auth::user()->mobile );
    }
    
    public function create_verify(Request $request){
        if($request->input('id') and $request->input('Authority') ){
            $financial = DB::table('financial')->where('id',$request->input('id'))->where('id_users', auth::user()->id)->where('status', 'unpaid')->first();
                if(isset($financial)){
                    if($request->input('Status') == 'OK'){
                        
                        $pay = new PayController();
                        if($pay->verify($financial->price,$request->input('Authority')) == false){
                            session()->put('pmError','مشکل امنیتی در پرداخت');
                            return redirect()->route('panel.financial.index');
                        }
                        
                        DB::table('financial')->where('id',$request->input('id'))->update([
                            'authority' => $request->input('Authority'),
                            'date_paid' => date("Y-m-d H:i:s"),
                            'status' => 'paid',
                        ]);
                        $book = DB::table('book')->insertGetId([
                            'id_users' => Auth::user()->id,
                            'cover_status' => 'deactive',
                            'buy' => $financial->value,
                            'date' =>  date("Y-m-d H:i:s"),
                            'date_update' =>  date("Y-m-d H:i:s"),
                            'status_publish' => 'writing',
                            'status' => 'deactive',
                        ]);
                        session()->put('pmSuccess','پرداخت شما با موفقیت انجام شد');
                        session()->put('pmInfo','کتاب جدید شما آماده است');
                        return redirect()->route('panel.author.edit');
                    }else{
                        session()->put('pmError','پرداخت شما انجام نشد');
                        DB::table('financial')->where('id',$request->input('id'))->delete();
                    }
                }else{
                    session()->put('pmError','پرداخت شما انجام نشد');
                }
        }else{
            session()->put('pmError','پرداخت شما انجام نشد');
        }

        return redirect()->route('panel.financial.index');
    }
    
    public function create_gift(Request $request){
        $gift_code = DB::table('gift_code')->where('code', $request->code)->where('type', 'author')->where('status', 'active')->first();
        if(isset($gift_code)){
            if($gift_code->expire >= date("Y-m-d H:i:s")){
                if($gift_code->use >=1 or $gift_code->use == null){
                    $gift = DB::table('gift')->where('id_users', auth::user()->id)->where('id_gift', $gift_code->id)->count();
                    if($gift == 0){
                        if($gift_code->use != null){
                            DB::table('gift_code')->where('id', $gift_code->id)->update([
                                'use' => ($gift_code->use - 1)
                            ]);
                        }
                        DB::table('gift')->insert([
                            'id_users' => Auth::user()->id,
                            'id_gift' => $gift_code->id,
                        ]);
                        $book = DB::table('book')->insertGetId([
                            'id_users' => Auth::user()->id,
                            'cover_status' => 'deactive',
                            'buy' => $gift_code->value,
                            'date' =>  date("Y-m-d H:i:s"),
                            'date_update' =>  date("Y-m-d H:i:s"),
                            'status_publish' => 'writing',
                            'status' => 'deactive',
                        ]);
                        session()->put('pmSuccess','کد اعتبار نویسندگی شما با موفقیت پذیرفته شد');
                        session()->put('pmInfo','کتاب جدید شما آماده است');
                        $data['status'] = true;
                    }else{
                        $data['status'] = false;
                        $data['message'] = 'شما قبلا از این کد اعتبار استفاده کرده اید'; 
                    }  
                }else{
                    $data['status'] = false;
                    $data['message'] = 'کد اعتبار نویسندگی تمام شده است'; 
                }  
            }else{
                $data['status'] = false;
                $data['message'] = 'کد اعتبار نویسندگی منقضی شده است'; 
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'کد اعتبار نویسندگی شما اشتباه است';
        }
        return $data;
    }

    public function edit(){
        $book = DB::table('book')->where('id_users', auth::user()->id)->get(['id','name','cover','type','cover_text','cover_status','status']);
        return view('panel.author.edit',['book'=>$book]);
    }
    
    public function edit_show($id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->first();
        if(isset($book)){
            $category_book_list_all = DB::table('category_book_list')->where('id_book', $book->id)->get(['id_category']);
            $category_book_list = null;
            foreach($category_book_list_all as $rows){
                $category_book_list[] = $rows->id_category;
            }
            if(is_file($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book->id.".zip")){
                unlink($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book->id.".zip");
            }
            $order_book_count = DB::table('order_book')->where('id_book', $id)->where('status', 'active')->count();
            $book_season_active = DB::table('book_season')->where('id_book', $id)->where('status','active')->orderBy('id','DESC')->get();
            $book_season_deactive = DB::table('book_season')->where('id_book', $id)->where('status','deactive')->orderBy('id','DESC')->first();
            $category = DB::table('category_book')->where('status','active')->get(['id','sub','name']);
            return view('panel.author.edit_show',['book'=>$book,'category_book_list'=>$category_book_list,'category'=>$category,'order_book_count'=>$order_book_count,'book_season_active'=>$book_season_active,'book_season_deactive'=>$book_season_deactive]);
        }else{
            abort(404);
        }
    }
        
    public function edit_show_pageNew(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
            $book_season = DB::table('book_season')->where('id_book', $book->id)->where('status','deactive')->where('status_publish','writing')->first();
            if(count($book_season) == 1){
         
                $page_count = count( glob($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/*.txt") );
                if($page_count <= 50){
          
                    $filename = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/".$page_count.".txt";
                    $fp = fopen($filename, "r");
                    if(filesize($filename) != 0){
                        $content = fread($fp, filesize($filename));
                    }else{
                        $content = '';
                    }
                    $lines = explode("\n", $content);
                    fclose($fp);
                    $content = implode("\n", $lines);
                
                    $functionMe = new functionMe;
                    $count_context = $functionMe->count_context(strip_tags($content));
                    if($count_context>=250){
                        $file = fopen($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/".($page_count+1).".txt", "w+");
                        fwrite($file, '');
                        fclose($file);
                        
                        $data['page'] = $page_count+1;
                        $data['status'] = true;
                        $data['message'] = 'صفحه جدید برای فصل '.$book->id.' به کتاب اضافه شد'; 
                    }else{
                        $data['status'] = false;
                        $data['message'] = 'برای ساخت صفحه جدید نیاز است ، صفحه '.$page_count.' حداقل 250 کلمه داشته باشد';
                    }
                
                }else{
                    $data['status'] = false;
                    $data['message'] = 'شما حداکثر میتوانید 50 صفحه در هر فصل داشته باشید';
                }
               
            }else{
               $data['status'] = false;
                $data['message'] = 'همچین فصلی برای کتاب وجود ندارد'; 
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'همچین کتابی وجود ندارد';
        }
        return $data;
    }
    
    public function edit_show_pageChange(Request $request,$id){
       
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
            $book_season = DB::table('book_season')->where('id_book', $book->id)->where('status','deactive')->where('status_publish','writing')->first();
            if(count($book_season) == 1){

                if(is_file($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/".$request->change.".txt")){
               
                    $filename = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/".$request->change.".txt";
                    $fp = fopen($filename, "r");
                    if(filesize($filename) != 0){
                        $content = fread($fp, filesize($filename));
                    }else{
                        $content = '';
                    }
                    $lines = explode("\n", $content);
                    fclose($fp);
                    $content = implode("\n", $lines);

                    $data['page'] = $request->change;
                    $data['context'] = $content;
                    $data['status'] = true;
                    $data['message'] = 'صفحه '.$request->change.' از فصل '.$book_season->season.' آماده ویرایش است'; 
                
                }else{
                    $data['status'] = false;
                    $data['message'] = 'همچین صفحه ای وجود ندارد';
                }
               
            }else{
               $data['status'] = false;
                $data['message'] = 'همچین فصلی برای کتاب وجود ندارد'; 
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'همچین کتابی وجود ندارد';
        }
        return $data;
    }
    
    public function edit_show_pageSave(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
            $book_season = DB::table('book_season')->where('id_book', $book->id)->where('status','deactive')->where('status_publish','writing')->first();
            if(count($book_season) == 1){
           
                if(is_file($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/".$request->page.".txt")){
                    
                    $functionMe = new functionMe;
                    $count_context = $functionMe->count_context(strip_tags($request->context));
                    if($count_context<=500){
        
                        $file = fopen($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/".$request->page.".txt", "w+");
                        fwrite($file, strip_tags($request->context));
                        fclose($file);
            
                        $data['status'] = true;
                        $data['message'] = 'پیش نویس صفحه '.$request->page.' از فصل '.$book_season->season.' ذخیره شد'; 
                     
                    }else{
                        $data['status'] = false;
                        $data['message'] = 'هر صفحه حداکثر 500 کلمه میتواند داشته باشد';
                    }
                }else{
                    $data['status'] = false;
                    $data['message'] = 'همچین صفحه ای برای این فصل از کتاب وجود ندارد';
                }
               
            }else{
               $data['status'] = false;
                $data['message'] = 'همچین فصلی برای کتاب وجود ندارد'; 
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'همچین کتابی وجود ندارد';
        }
        return $data;
    }
    
    public function edit_show_seasonNew(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
            $book_season_deactive = DB::table('book_season')->where('id_book', $id)->where('status','deactive')->count();
            if($book_season_deactive == 0){
                $book_season_active = DB::table('book_season')->where('id_book', $id)->where('status','active')->count();
                if($book_season_active <= 20){
                    
                    File::makeDirectory($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".($book_season_active + 1), 0777, true, true);
                    $file = fopen($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".($book_season_active + 1)."/1.txt", "w+");
                    fwrite($file, '');
                    fclose($file);
                    
                    DB::table('book_season')->insert([
                            'id_book'=> $id,
                            'season'=> $book_season_active + 1,
                            'date'=> date("Y-m-d H:i:s"),
                            'status_publish'=> 'writing',
                            'status'=> 'deactive',
                    ]);
                    
                    DB::table('book')->where('id',$id)->update([
                            'status_publish'=> 'writing',
                    ]);
                    
                    session()->put('pmSuccess','فصل جدید به کتاب شما اضافه شد');
                    
                }else{
                    session()->put('pmError','شما حداکثر میتوانید 20 فصل داشته باشید');
                }
            }else{
                session()->put('pmError','لطفا اول فصل های قبلی خود را انتشار دهید');
            }
            return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
        }else{
            abort(404);
        }
    }
    
    public function edit_show_backup($id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
            
            if(is_file($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book->id.".zip")){
                unlink($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book->id.".zip");
            }
            
            $zipper = new ZipArchiverController;
            $dirPath = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/"; 
            $zipPath = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book->id.".zip"; 
            $zip = $zipper->zipDir($dirPath, $zipPath);

            $file = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book->id.".zip";
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }
        }else{
            abort(404);
        }
    }
    
    public function edit_show_seasonPublish(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
            $book_season = DB::table('book_season')->where('id_book', $id)->where('status','deactive')->where('status_publish','writing')->first();
            if(count($book_season) == 1){

                $page_count = count( glob($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$book_season->season."/*.txt") );
                
                if($book->type == 'text'){
                    $limit= 10;
                }else{
                    $limit= 5;
                }
                
                if($page_count < $limit){
                    $data['status'] = false;
                    $data['message'] ='فصل کتاب شما جهت انتشار باید حداقل '.$limit.' صفحه باشد';
                }else{
                    DB::table('book_season')->where('id_book',$id)->where('status','deactive')->where('status_publish','writing')->update([
                        'status_publish' => 'completed'
                    ]);
                    DB::table('book')->where('id',$id)->update([
                        'status_publish'=> 'completed',
                    ]);
                    $data['status'] = true;
                    $data['link'] = route('panel.author.edit_show', ['id'=>$id]);
                    session()->put('pmSuccess','فصل انتخاب شده شما انتشار پیدا کرد');
                    session()->put('pmInfo','فصل انتشار داده شده شما برای ناظر ارسال شد');
                }
                
            }else{
                $data['status'] = false;
                $data['message'] = 'شما دسترسی برای انتشار این فصل را ندارید';
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'شما دسترسی برای انتشار این فصل را ندارید';
        }
        return $data;
    }
    
    public function edit_show_setting(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'active')->first();
        if(isset($book)){
                if($request->price == null){
                    DB::table('book')->where('id',$id)->update([
                        'price'=>0,
                    ]);
                }elseif(isset($request->price)){
                    if($request->price <= 1000 and $request->price != 0){
                        session()->put('pmError','فیلد قیمت باید حداقل 1,000 تومان باشد و یا مقدار خالی به منظور رایگان بودن باشد');
                        return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                    }
                    DB::table('book')->where('id',$id)->update([
                        'price'=>$request->price,
                    ]);
                }
                
                if(isset($request->context)){
                    DB::table('book')->where('id',$id)->update([
                        'context'=> strip_tags($request->context),
                    ]);
                }
                
                session()->put('pmSuccess','تنظیمات کتاب شما ثبت شد');
                return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
         
        }else{
            abort(404);
        }
    }
    
    public function edit_show_settingFirst(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'deactive')->first();
        if(isset($book)){
            if($book->name == null){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'name_en' => 'required|max:255',
                    'type' => 'required',
                    'category' => 'required',
                ],
                [
                    'category.required' => 'لطفا دسته بندی کتاب را وارد کنید',
                    'type.required' => 'لطفا نوع کتاب را را وارد کنید',
                    'name_en.max' => 'نام انگلیسی کتاب حداکثر 255 کاراکتر مجاز است',
                    'name_en.required' => 'لطفا نام انگلیسی کتاب  را وارد کنید',
                    'name.max' => 'نام کتاب حداکثر 255 کاراکتر مجاز است',
                    'name.required' => 'لطفا نام کتاب را وارد کنید',
                ]);
                if(count($validator->messages()) != 0){
                   session()->put('pmError',$validator->errors()->first());
                   return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                }else{
                    if($request->type == 'text' or $request->type == 'text_short'){
                    }else{
                        session()->put('pmError','نوع کتاب وارد شده غیر مجاز است');
                        return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                    }
                    $category_book = DB::table('category_book')->whereIn('id', $request->category)->where('status', 'active')->count();
                    if($category_book != count($request->category)){
                        session()->put('pmError','دسته بندی کتاب وارد شده غیر مجاز است');
                        return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                    }
                    
                    //cover
                    if($book->buy == 'no-cover'){
              
                        $validator2 = Validator::make($request->all(), [
                            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                        ],
                        [
                            'cover.image' => 'عکس جلد کتاب فقط میتواند از نوع عکس باشد',
                            'cover.mimes' => 'فرمت عکس جلد کتاب میتواند (jpeg,png,jpg) باشد',
                            'cover.max' => 'حجم عکس جلد کتاب باید کمتر از 2 مگ باشد',
                            'cover.required' => 'لطفا عکس جلد کتاب خود را انتخاب کنید',
                        ]);
                        if(count($validator2->messages()) != 0){
                            session()->put('pmError',$validator2->errors()->first());
                            return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                        }else{
                            if(isset($request->cover)) {
                                $coverDir = "/images/book/";
                                $coverFile = $request->file('cover');
                                $coverName = time().rand(1000,9999).'.'.$coverFile->getClientOriginalExtension();
                                $coverIs = $coverFile->move($_SERVER["DOCUMENT_ROOT"].$coverDir, $coverName);
                                DB::table('book')->where('id',$id)->update(
                                    [
                                        'cover' => $coverName,
                                    ]
                                );
                                session()->put('pmWarning','در انتظار تایید ناظر');
                            }
                        }
                    }elseif($book->buy == 'simple-cover' or $book->buy == 'professional-cover' ){  //cover_text
                        $validator2 = Validator::make($request->all(), [
                            'cover_text' => 'required',
                        ],
                        [
                            'cover_text.required' => 'لطفا توضیحات طراحی جلد کتاب را وارد کنید',
                        ]);
                        if(count($validator2->messages()) != 0){
                            session()->put('pmError',$validator2->errors()->first());
                            return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                        }else{
                            DB::table('book')->where('id',$id)->update([
                                'cover_text'=>$request->cover_text,
                            ]);
                            session()->put('pmWarning','درخواست طراحی جلد به واحد گرافیک انتقال یافت');
                        }
                    }
                    
                    DB::table('book')->where('id',$id)->update([
                        'name'=>$request->name,
                        'name_en'=>$request->name_en,
                        'type'=>$request->type,
                    ]);
                    foreach($request->category as $rows){
                        DB::table('category_book_list')->insert([
                            'id_book'=>$id,
                            'id_category'=>$rows,
                        ]);
                    }
                    session()->put('pmSuccess','تنظیمات اولیه کتاب شما ثبت شد');
                    return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    
    public function edit_show_coverFirst(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->where('id_users', auth::user()->id)->where('status', 'deactive')->first();
        if(isset($book)){
            if($book->name != null and $book->cover == null and $book->buy == 'no-cover'){
                $validator = Validator::make($request->all(), [
                    'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'cover.image' => 'عکس جلد کتاب فقط میتواند از نوع عکس باشد',
                    'cover.mimes' => 'فرمت عکس جلد کتاب میتواند (jpeg,png,jpg) باشد',
                    'cover.max' => 'حجم عکس جلد کتاب باید کمتر از 2 مگ باشد',
                    'cover.required' => 'لطفا عکس جلد کتاب خود را انتخاب کنید',
                ]);
                if(count($validator->messages()) != 0){
                    session()->put('pmError',$validator->errors()->first());
                    return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                }else{
                    if(isset($request->cover)) {
                        $coverDir = "/images/book/";
                        $coverFile = $request->file('cover');
                        $coverName = time().rand(1000,9999).'.'.$coverFile->getClientOriginalExtension();
                        $coverIs = $coverFile->move($_SERVER["DOCUMENT_ROOT"].$coverDir, $coverName);
                        DB::table('book')->where('id',$id)->update(
                            [
                                'cover' => $coverName,
                            ]
                        );
                        session()->put('pmWarning','در انتظار تایید ناظر');
                        session()->put('pmSuccess','جلد کتاب با موفقیت آپلود شد');
                        return redirect()->route('panel.author.edit_show',['id'=>$book->id]);
                    }
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    
    public function education(){
        return view('panel.author.education');
    }
    
}