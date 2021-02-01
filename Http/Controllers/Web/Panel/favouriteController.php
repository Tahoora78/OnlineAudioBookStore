<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;

class favouriteController extends Controller
{
    
    public function index(){
        if(auth::user()->favourite != null){
            $book = DB::table('book')->whereIn('id', json_decode(auth::user()->favourite,true))->where('status','active')->get(['id','name','name_en','type','cover']);        
        }else{
            $book = null;        
        }
        return view('panel.favourite.index',['book'=>$book]);
    }
    
}