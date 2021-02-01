<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\MailController;

class monitorBookController extends Controller
{


    public function index()
    {
        $book = DB::table('book')->where('cover','!=',null)->where('cover_status','deactive')->where('status','deactive')->orderBy('id','ASC')->get(['id','name','name_en','cover_notification','buy','type','category','cover']);
        $category = DB::table('category_book')->where('status','active')->get(['id','sub','name']);
        return view('admin.monitorBook.index',['book'=>$book,'category'=>$category]);
    }
    
    public function status(Request $request,$id)
    {
        $book = DB::table('book')->where('cover','!=',null)->where('cover_status','deactive')->where('status','deactive')->where('id',$id)->first();
        if(isset($book)){
            
            $users = DB::table('users')->where('id',$book->id_users)->first(['mobile','email']);
            $sms = new SmsController;
            $mail = new MailController;
            
            if($request->btn == 'active'){
                
                DB::table('book')->where('id',$book->id)->update([
                    'name'=>$request->name,
                    'name_en'=>$request->name_en,
                    'type'=>$request->type,
                    'cover_text'=>null,
                    'cover_notification'=>null,
                    'cover_status'=>'active',
                    'status'=>'active',
                ]);
                DB::table('category_book_list')->where('id_book',$book->id)->delete();
                foreach($request->category as $rows){
                    DB::table('category_book_list')->where('id',$book->id)->insert([
                        'id_book'=>$book->id,
                        'id_category'=>$rows,
                    ]);
                }
                if($users->email != null){
                    $mail->send('پیام ناظر رمان خوان',
                                $users->email,
                                'نویسنده محترم رمان خوان',
                                'کتاب '.$book->id.' با موفقیت تایید شد.');
                }
                if($users->mobile != null){
                    $sms->send([$users->mobile],['book'=>$book->id],'wqmxggs5re');
                }
                session()->put('pmSuccess','تنظیمات اولیه کتاب با موفقیت تایید شد');
                
            }elseif($request->btn == 'deactive'){
                
                $coverDir = "/images/book/";
                unlink($_SERVER['DOCUMENT_ROOT'].$coverDir.$book->cover);
                DB::table('book')->where('id',$book->id)->update([
                    'cover'=>null,
                    'cover_notification'=>$request->notification,
                    'cover_status'=>'deactive',
                    'status'=>'deactive',
                ]);
                if($users->email != null){
                    $mail->send('پیام ناظر رمان خوان',
                                $users->email,
                                'نویسنده محترم رمان خوان',
                                'کتاب '.$book->id.'  تایید نشد.');
                }
                if($users->mobile != null){
                    $sms->send([$users->mobile],['book'=>$book->id],'xh813mvfn1');
                }
                session()->put('pmSuccess','تنظیمات اولیه کتاب رد شد');
                
            }else{
                session()->put('pmError','نامعتبر');
            }
        }else{
            session()->put('pmError','کتابی وجود ندارد');
        }
        return redirect()->route('panel.admin.monitorBook.index');
    }

}
