<?php
namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use DB;
 
    
class tagController extends Controller
{
    
    public function show($tag){
        
        $blog = DB::table('tag')->where('tag.key',str_replace('_', ' ',$tag))->where('tag.type','blog')->orderBy('tag.id_post','DESC')->
        join('blog','blog.id','tag.id_post')->
        select(['blog.id','blog.title','blog.title_en','blog.context_short','blog.date','blog.cover'])->
        paginate(12);
        
        $book = DB::table('tag')->where('tag.key',str_replace('_', ' ',$tag))->where('tag.type','book')->orderBy('tag.id_post','DESC')->
        join('book','book.id','tag.id_post')->
        select(['tag.id_post'])->
        paginate(12);
        
        if(count($blog) >= 1 or count($book) >= 1){
            return view('site.tag.show',['tag'=>$tag,'blog'=>$blog,'book'=>$book]);
        }else{
            abort(404);
        }
    }
    
}