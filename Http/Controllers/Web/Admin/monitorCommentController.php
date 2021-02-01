<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;

class monitorCommentController extends Controller
{


    public function index()
    {
        $comment_book = DB::table('comment_book')->where('status','deactive')->orderBy('id','ASC')->get();
        return view('admin.monitorComment.index',['comment_book'=>$comment_book]);
    }
    
    public function status(Request $request,$id)
    {
        $comment_book = DB::table('comment_book')->where('status','deactive')->where('id',$id)->first();
        if(isset($comment_book)){
            
            if($request->btn == 'active'){
                
                DB::table('comment_book')->where('id',$id)->update([
                    'context'=>$request->context,
                    'status'=>'active',
                ]);
                session()->put('pmSuccess','نظر کاربر با موفقیت تایید شد');
                
            }elseif($request->btn == 'deactive'){
                
                DB::table('comment_book')->where('id',$id)->delete();
                session()->put('pmSuccess','نظر کاربر حذف شد');
                
            }else{
                session()->put('pmError','نامعتبر');
            }
        }else{
            session()->put('pmError','نظری وجود ندارد');
        }
        return redirect()->route('panel.admin.monitorComment.index');
    }


}
