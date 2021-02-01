<?php
namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use DB;
use Auth;
 
    
class blogController extends Controller
{

    public function index(){
        $blog = DB::table('blog')->where('status','active')->orderBy('id','DESC')->select(['id','title','title_en','context_short','date','cover'])->paginate(6);
        return view('site.blog.index',['blog'=>$blog]);
    }
    
    public function show($id){
        $blog = DB::table('blog')->where('id',$id)->first();
        if(isset($blog)){
            
            if(Auth::guest()){
                $id_users = null;
            }else{
                $id_users = Auth::user()->id;
            }
            
            if($blog->status == 'active' or in_array($id_users , config('constants.role')['root'])){
                DB::table('blog')->where('id',$id)->update([
                    'view' => $blog->view + 1,
                ]);
                $blog_last = DB::table('blog')->where('status','active')->orderBy('id','DESC')->select(['id','title','title_en','date','cover'])->take(4)->get();
                $tag = DB::table('tag')->where('id_post',$id)->where('type','blog')->get(['key']);
                return view('site.blog.show',['blog'=>$blog,'tag'=>$tag,'blog_last'=>$blog_last]);
            }
        }
        abort(404);
        
    }
    
}