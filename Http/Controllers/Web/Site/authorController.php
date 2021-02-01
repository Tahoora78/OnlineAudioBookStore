<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;

class authorController extends Controller
{
    
    public function index(){
        return view('site.author.index');
    }
    
    public function show($id){
        $users = DB::table('users')->where('id',$id)->first(['id','name','avatar']);
        if(isset($users)){
            $book = DB::table('book')->where('id_users', $users->id)->where('status','active')->select(['id','name','name_en','cover','type'])->paginate(20);
            $follower_count = DB::table('follower')->where('following', $users->id)->count();
            
            if(Auth::guest()){
                $follow = 0;
            }else{
                $follow = DB::table('follower')->where('id_users',Auth::user()->id)->where('following', $id)->count();
            }
            
            $book_id[] = null;
            foreach($book as $rows){
                $book_id[] = $rows->id;
            }
            $comment_count_star['total'] = DB::table('comment_book')->whereIn('id_book', $book_id)->where('status', 'active')->count();
            $comment_sum_star['total'] = DB::table('comment_book')->whereIn('id_book', $book_id)->where('status', 'active')->sum('star');
            return view('site.author.show', ['users'=>$users,'book'=>$book,'follow'=>$follow,'follower_count'=>$follower_count,'comment_count_star'=>$comment_count_star,'comment_sum_star'=>$comment_sum_star]);
        }else{
            abort(404);
        }
    }
    
    public function follow(Request $request,$id){
        $users = DB::table('users')->where('id',$id)->where('status','active')->first(['name']);
        if(count($users) == 1){
            if(Auth::user()->id == $id){
                session()->put('pmError','شما نمیتوانید خود را دنبال کنید');
                return redirect()->route('site.author.show',['id'=>$id,'name'=>str_replace(' ', '-',$users->name)]);
            }
            $follower = DB::table('follower')->where('id_users',Auth::user()->id)->where('following', $id)->count();
            if($follower == 1){
                DB::table('follower')->where('id_users',Auth::user()->id)->where('following',$id)->delete();
                session()->put('pmSuccess','نویسنده انتخاب شده از لیست دنبال کننده شما حذف شد');
            }else{
                DB::table('follower')->insert([
                    'id_users' => Auth::user()->id,
                    'following' => $id,
                ]);
                session()->put('pmSuccess','نویسنده انتخاب شده به لیست دنبال کننده شما اضافه شد');
            }
            return redirect()->route('site.author.show',['id'=>$id,'name'=>str_replace(' ', '-',$users->name)]);
        }
        session()->put('pmError','همچین نویسنده ای وجود ندارد');
        return redirect()->route('site.dashboard.index');
    }
}