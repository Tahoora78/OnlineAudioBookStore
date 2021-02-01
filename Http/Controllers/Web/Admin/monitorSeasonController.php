<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\MailController;
use App\Functions\functionMe;

class monitorSeasonController extends Controller
{

    public function index()
    {
        $book_season = DB::table('book_season')->where('book_season.status_publish','completed')->where('book_season.status','deactive')->
                        join('book','book.id','book_season.id_book')->
                        orderBy('book_season.id','ASC')->
                        get(['book_season.id','book.name','book_season.season']);
        return view('admin.monitorSeason.index',['book_season'=>$book_season]);
    }
    
    public function show($id)
    {   
        $book_season = DB::table('book_season')->where('id',$id)->where('status_publish','completed')->where('status','deactive')->first();
        if(isset($book_season)){
            return view('admin.monitorSeason.show',['book_season'=>$book_season]);
        }else{
            abort(404);
        }
    }
    
    public function status(Request $request,$id)
    {
        $book_season = DB::table('book_season')->where('id',$id)->where('status_publish','completed')->where('status','deactive')->first();
        if(isset($book_season)){
            
            $book = DB::table('book')->where('id',$book_season->id_book)->first(['id_users']);
            $users = DB::table('users')->where('id',$book->id_users)->first(['mobile','email']);
            $sms = new SmsController;
            $mail = new MailController;
            
            if($request->btn == 'active'){
                $page = count( glob($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book_season->id_book."/".$book_season->season."/*.txt") );
                DB::table('book_season')->where('id',$book_season->id)->update([
                    'page'=> $page,
                    'notification'=> null,
                    'status_publish'=>'completed',
                    'status'=>'active',
                ]);
                if($users->email != null){
                    $mail->send('پیام ناظر رمان خوان',
                                $users->email,
                                'نویسنده محترم رمان خوان',
                                'فصل '.$book_season->season.' از کتاب '.$book_season->id_book.' با موفقیت تایید شد.');
                }
                if($users->mobile != null){
                    $sms->send([$users->mobile],['season'=>$book_season->season,'book'=>$book_season->id_book],'rx58sqg3pz');
                }
                session()->put('pmSuccess','فصل کتاب با موفقیت تایید شد');
                
            }elseif($request->btn == 'deactive'){
                
                DB::table('book_season')->where('id',$book_season->id)->update([
                    'notification'=>$request->notification,
                    'status_publish'=>'writing',
                    'status'=>'deactive',
                ]);
                if($users->email != null){
                    $mail->send('پیام ناظر رمان خوان',
                                $users->email,
                                'نویسنده محترم رمان خوان',
                                'فصل '.$book_season->season.' از کتاب '.$book_season->id_book.'  تایید نشد.');
                }
                if($users->mobile != null){
                    $sms->send([$users->mobile],['season'=>$book_season->season,'book'=>$book_season->id_book],'h6kq0jj3pr');
                }
                session()->put('pmSuccess','فصل کتاب رد شد');
                
            }else{
                session()->put('pmError','نامعتبر');
            }
        }else{
            session()->put('pmError','کتابی وجود ندارد');
        }
        return redirect()->route('panel.admin.monitorSeason.index');
    }

}
