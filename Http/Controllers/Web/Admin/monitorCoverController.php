<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;
use Validator;

class monitorCoverController extends Controller
{


    public function index()
    {
        $book = DB::table('book')->where('book.cover',null)->where('book.cover_text','!=',null)->where('book.buy','!=','no-cover')->where('book.status','deactive')->
                join('users','users.id','book.id_users')->
                orderBy('book.id','ASC')->
                get(['users.name as users_name','users.mobile as users_mobile','users.email as users_email','book.id as id_book','book.name as book_name','book.cover_text as book_coverText']);
        return view('admin.monitorCover.index',['book'=>$book]);
    }
    
    
    
    public function upload(Request $request,$id){
        $book = DB::table('book')->where('id', $id)->first();
        if(isset($book)){
            if($book->cover == null and $book->cover_status == 'deactive' and $book->buy != 'no-cover'){
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
                        session()->put('pmSuccess','عکس جلد کتاب شما ثبت شد');
                    }
                }
            }
        }
        return redirect()->route('panel.admin.monitorCover.index');
    }

}
