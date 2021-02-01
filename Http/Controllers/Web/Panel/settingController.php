<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;

class settingController extends Controller
{
    
    public function index(){
        if(auth::user()->setting != null){
            $setting = json_decode(auth::user()->setting,true);
        }else{
            $setting['study']['web'] = ['theme'=>'1','font'=>'1','size'=>'20','line'=>'40'];
        }
        return view('panel.setting.index',['setting'=>$setting]);
    }
    
    public function update(Request $request){
        if($request->size >= 10 and $request->size <= 30){
            if($request->line >= 20 and $request->line <= 80){
                if(isset(config('constants.theme_web')[$request->theme])){
                    if(isset(config('constants.font_web')[$request->font])){
                        if(auth::user()->setting != null){
                        $setting = json_decode(auth::user()->setting,true);
                        }
                        $setting['study']['web'] = ['theme'=>$request->theme,'font'=>$request->font,'size'=>$request->size,'line'=>$request->line];
                        DB::table('users')->where('id',auth::user()->id)->update([
                            'setting'=>json_encode($setting),
                        ]);
                        $data['text_color'] = config('constants.theme_web')[$request->theme]['text_color'];
                        $data['text_background'] = config('constants.theme_web')[$request->theme]['text_background'];
                        $data['text_color2'] = config('constants.theme_web')[$request->theme]['text_color2'];
                        $data['text_background2'] = config('constants.theme_web')[$request->theme]['text_background2'];
                        $data['font'] = config('constants.font_web')[$request->font]['key'];
                        $data['size'] = $request->size;
                        $data['line'] = $request->line;
                        $data['status'] = true;
                        $data['message'] = 'تنظیمات مطالعه وب شما ثبت شد'; 
                    }else{
                        $data['status'] = false;
                    $data['message'] = 'فونت انتخاب شده نامعتبر است';
                    }
                }else{
                    $data['status'] = false;
                    $data['message'] = 'تم انتخاب شده نامعتبر است';
                }
            }else{
                $data['status'] = false;
                $data['message'] = 'اندازه متن باید بین 10 تا 30 باشد';
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'اندازه متن باید بین 10 تا 30 باشد';
        }
        return $data;
    }    
    
}