<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;

class commentController extends Controller
{
    
    public function store(Request $request,$id){
        $order_book = DB::table('order_book')->where('id_book',$id)->where('id_users',auth::user()->id)->first();
        if(isset($order_book)){
            $comment_book = DB::table('comment_book')->where('id_book',$id)->where('id_users',auth::user()->id)->count();
            if($comment_book == 0){
             
                    if(isset($request->star) and isset($request->context)){
              
                        if($request->star>=1 and $request->star<=5){
                            DB::table('comment_book')->insert([
                                'id_users'=>auth::user()->id,
                                'id_book'=>$id,
                                'context'=> strip_tags($request->context),
                                'star'=>$request->star,
                                'date'=> date("Y-m-d H:i:s"),
                                'status'=> 'deactive',
                            ]);
                            $data['status'] = true;
                            $data['message'] = 'نظر شما با موفقیت ثبت شد'; 
                            
                        }else{
                            $data['status'] = false;
                            $data['message'] = 'شما باید حداقل یک ستاره و حداکثر پنج ستاره امتیاز دهید';
                        }
                    
                    }else{
                        $data['status'] = false;
                        $data['message'] = 'لطفا نظر خود را بنویسید و بین یک تا پنج ستاره امتیاز دهید';
                    }
                   
            }else{
                $data['status'] = false;
                $data['message'] = 'شما در گذشته برای این کتاب نظر ثبت کردید';
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'شما این کتاب را در کتابخانه خود ندارید';
        }
        return $data;
    }
    
}