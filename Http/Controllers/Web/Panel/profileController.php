<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class profileController extends Controller
{
    
    public function index(){
        return view('panel.profile.index');
    }
    
    public function password(Request $request){
        $validator = Validator::make($request->all(), [
            'password_old' => 'required',
            'password' => 'required|string|min:4|max:100|confirmed',
            'password_confirmation' =>'required',
        ],
        [
            'password_old.required' => 'لطفا رمز عبور فعلی خود را وارد کنید',
            'password.confirmed' => 'لطفا تکرار رمز عبور خود را وارد کنید',
            'password.max' => 'طول رمز عبور باید کمتر از 100 کاراکتر باشد',
            'password.min' => 'طول رمز عبور باید بیشتر از 4 کاراکتر باشد',
            'password.required' => 'تکرار رمز عبور با رمز عبور یکسان نیست',
            'password_confirmation.required' =>  'لطفا رمز عبور خود را وارد کنید',
        ]);

        if(count($validator->messages()) != 0){
           session()->put('pmError',$validator->errors()->first());
        }elseif(!Hash::check($request->password_old,Auth::user()->password)){
            session()->put('pmError','رمز عبور فعلی شما اشتباه است');
        }else{
            DB::table('users')->where('id',Auth::user()->id)->update([
                'password'=> Hash::make($request->password),
            ]);
            session()->put('pmSuccess','رمز عبور شما با موفقیت تغییر پیدا کرد');
        }
        return redirect()->route('panel.profile.index');
    }
    
    public function avatar(Request $request){
        $validator = Validator::make($request->all(), [
            'avarat' => 'image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'avarat.image' => 'عکس پروفایل فقط میتواند از نوع عکس باشد',
            'avarat.mimes' => 'فرمت عکس پروفایل میتواند (jpeg,png,jpg) باشد',
            'avarat.max' => 'حجم عکس پروفایل باید کمتر از 2 مگ باشد',
        ]);

        if(count($validator->messages()) != 0){
           session()->put('pmError',$validator->errors()->first());
        }else{
            if(isset($request->avatar)) {

                $avatarDir = "/images/avatar/";
                if(Auth::user()->avatar != null){
                    unlink($_SERVER['DOCUMENT_ROOT'].$avatarDir.Auth::user()->avatar);
                    DB::table('users')->where('id',Auth::user()->id)->update(
                        [
                            'avatar' => null,
                        ]
                    );
                }
                    
                $avatarFile = $request->file('avatar');
                $avatarName = time().rand(1000,9999).'.'.$avatarFile->getClientOriginalExtension();
                $avatarIs = $avatarFile->move($_SERVER["DOCUMENT_ROOT"].$avatarDir, $avatarName);
                
                DB::table('users')->where('id',Auth::user()->id)->update(
                    [
                        'avatar' => $avatarName,
                    ]
                );
                
                session()->put('pmSuccess','عکس پروفایل شما با موفقیت آپلود شد');
            }else{
                session()->put('pmError','لطفا عکس پروفایل خود را انتخاب کنید');
            }
        }
        return redirect()->route('panel.profile.index');
    }
    
    public function avatar_delete(){
        if(Auth::user()->avatar != null){
            $avatarDir = "/images/avatar/";
            unlink($_SERVER['DOCUMENT_ROOT'].$avatarDir.Auth::user()->avatar);
            DB::table('users')->where('id',Auth::user()->id)->update(
                [
                    'avatar' => null,
                ]
            );
        }
        session()->put('pmSuccess','عکس پروفایل شما با موفقیت حذف شد');
        return redirect()->route('panel.profile.index');
    }
    
}