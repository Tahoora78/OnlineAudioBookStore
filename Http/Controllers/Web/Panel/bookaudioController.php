<?php
namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;

class bookaudioController extends Controller
{
    
    public function index(){
        $book = DB::table('order_book')->where('order_book.id_users',auth::user()->id)->
                join('book','book.id','order_book.id_book')->
                where('book.type','audio')->
                get(['book.id','book.name','book.cover']);
        return view('panel.bookaudio.index',['book'=>$book]);
    }
    
    public function show(){
        return view('panel.book.show');
    }
    
}