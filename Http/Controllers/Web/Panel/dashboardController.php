<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;

class dashboardController extends Controller
{
    
    public function index(){
        $book_rand = DB::table('book')->where('status', 'active')->orderByRaw('RAND()')->limit(1)->first(['id','name','name_en','context','type','cover']);
        $follower =  DB::table('follower')->
                        where('follower.id_users', auth::user()->id)->
                        join('users', 'users.id', 'follower.following')->
                        take(5)->
                        get(['users.id AS users_id','users.name AS users_name','users.avatar AS users_avatar']);
        $follower_all = DB::table('follower')->where('id_users', auth::user()->id)->get(['following']);
        $follower_count = count($follower_all);

        $book_last_follower = DB::table('book')->where('book.status', 'active')->whereIn('book.id_users',json_decode($follower_all,true))->
                            join('users', 'users.id', 'book.id_users')->
                            orderBy('book.id','DESC')->take(5)->
                            get(['users.id AS users_id','users.name AS users_name','book.id AS book_id','book.name AS book_name','book.name_en AS book_name_en','book.type AS book_type','book.cover AS book_cover']);
                            
        $order_all = DB::table('order_book')->where('id_users', auth::user()->id)->get(['id_book']);
        $book_last_season = DB::table('book_season')->where('book_season.status_publish', 'completed')->where('book_season.status', 'active')->whereIn('book_season.id_book',json_decode($order_all,true))->
                            join('book', 'book.id', 'book_season.id_book')->where('book.status', 'active')->
                            join('users', 'users.id', 'book.id_users')->
                            orderBy('book_season.id','DESC')->take(5)->
                            get(['users.id AS users_id','users.name AS users_name','book.id AS book_id','book.name AS book_name','book.cover AS book_cover','book.type AS book_type','book_season.season AS season']);
                            
        return view('panel.dashboard.index',['book_rand'=>$book_rand,'follower'=>$follower, 'follower_count'=>$follower_count,'book_last_follower'=>$book_last_follower,'book_last_season'=>$book_last_season]);
    }
    
}