<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;

class bookController extends Controller
{
    
    public function index(){
        $book = DB::table('order_book')->where('order_book.id_users',auth::user()->id)->
                join('book','book.id','order_book.id_book')->
                where('book.type','!=','audio')->
                where('book.status','active')->
                get(['book.id','book.name','book.cover']);
        return view('panel.book.index', ['book'=>$book]);
    }
    
    public function show($id){
        $book = DB::table('book')->where('id',$id)->first();
        if(isset($book)){
            $book_season = DB::table('book_season')->where('id_book',$id)->where('status_publish','completed')->where('status','active')->orderBy('season','ASC')->get(['season','page']);
            if(isset($book_season)){
                $order_book = DB::table('order_book')->where('id_book',$id)->where('id_users',auth::user()->id)->first();
                if(isset($order_book) or $book->id_users == auth::user()->id){
                    $page_all = DB::table('book_season')->where('id_book',$id)->where('status_publish','completed')->where('status','active')->sum('page');
                    $comment_book = DB::table('comment_book')->where('id_book',$id)->where('id_users',auth::user()->id)->first();
                    if(isset($order_book)){
                        if($order_book->mark == null){
                            $page = 1;
                        }else{
                            $page = $order_book->mark;
                        }
                    }else{
                        $page = 1;
                    }
                    return view('panel.book.show', ['book'=>$book,'page'=>$page,'page_all'=>$page_all,'comment_book'=>$comment_book,'book_season'=>$book_season]);
                }
            }
        }
        abort(404);
    }
    
    public function study(Request $request,$id){
        $book = DB::table('book')->where('id',$id)->first(['id','id_users']);
        if(isset($book)){
            $order_book = DB::table('order_book')->where('id_book',$id)->where('id_users',auth::user()->id)->first();
            if(isset($order_book) or $book->id_users == auth::user()->id){
                $page_is = DB::table('book_season')->where('id_book',$id)->where('status_publish','completed')->where('status','active')->sum('page');
                if($page_is >= $request->page and 1 <= $request->page){
                    $book_season = DB::table('book_season')->where('id_book',$id)->where('status_publish', 'completed')->where('status', 'active')->orderBy('season','ASC')->get(['season','page']);
                    $page_count = 0;
                    foreach($book_season as $rows){
                        if(($rows->page + $page_count) >= intval($request->page)){
                            $season = $rows->season;
                            $page = intval($request->page) - $page_count;
                            break;
                        }
                        $page_count += $rows->page;
                    }
                    
                    if(is_file($_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$season."/".$page.".txt")){
                        
                        if(isset($order_book)){
                            DB::table('order_book')->where('id_book',$id)->where('id_users',auth::user()->id)->update([
                                'mark'=> intval($request->page),    
                            ]);  
                        }
                        
                        $filename = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/".$season."/".$page.".txt";
                        $fp = fopen($filename, "r");
                        if(filesize($filename) != 0){
                            $content = fread($fp, filesize($filename));
                        }else{
                            $content = '';
                        }
                        $lines = explode("\n", $content);
                        fclose($fp);
                        $content = implode("\n", $lines);
        
                        $data['season'] = $season;
                        $data['page'] = $request->page;
                        $data['content'] = nl2br($content);
                        $data['status'] = true;
                    
                    }else{
                        $data['status'] = false;
                        $data['message'] = 'صفحه مورد نظر وجود ندارد';
                    }
                  
                }else{
                    $data['status'] = false;
                    $data['message'] = 'صفحه مورد نظر وجود ندارد';
                }
            }else{
                $data['status'] = false;
                $data['message'] = 'کتاب غیر فعال است';
            }
        }else{
            $data['status'] = false;
            $data['message'] = 'شما این کتاب را در کتابخانه خود ندارید';
        }
        return $data;
    }
    
}