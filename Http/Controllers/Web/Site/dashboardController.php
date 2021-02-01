<?php
namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use DB;
 
    
class dashboardController extends Controller
{
    public function index(){
        $last_book =  DB::table('book')->where('status','active')->orderBy('date', 'DESC')->take(12)->get(['name','id','cover','name_en','type']);
        
        $cat_asheqane_book =  DB::table('category_book_list')->where('category_book_list.id_category',1)->join('book','book.id','category_book_list.id_book')->orderBy('book.date', 'DESC')->take(12)->get(['book.name','book.id','book.cover','book.name_en','book.type']);
        
        $last_comment =  DB::table('comment_book')->
                        where('comment_book.status','active')->
                        join('book', 'book.id', 'comment_book.id_book')->
                        join('users', 'users.id', 'comment_book.id_users')->
                        orderBy('comment_book.date', 'DESC')->
                        take(12)->
                        get(['comment_book.context','book.name AS book_name','book.name_en AS book_name_en','book.id AS book_id','users.id AS users_id','users.name AS users_name','users.avatar AS users_avatar']);
        $count_book = DB::table('book')->where('status', 'active')->where('type','!=','audio')->count();
        $count_bookAudio = DB::table('book')->where('status', 'active')->where('type','audio')->count();
        $count_author = DB::table('book')->where('status', 'active')->groupBy('id_users')->count();
        
        return view('site.dashboard.index',['last_book'=>$last_book,'cat_asheqane_book'=>$cat_asheqane_book, 'last_comment'=>$last_comment, 'count_book'=>$count_book, 'count_bookAudio'=>$count_bookAudio, 'count_author'=>$count_author]);
    }
    
    public function about(){
        return view('site.dashboard.about');
    }
    
    public function faq(){
        return view('site.dashboard.faq');
    }
    
    public function rule(){
        return view('site.dashboard.rule');
    }
    
}