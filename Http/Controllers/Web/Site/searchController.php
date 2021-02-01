<?php
namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class searchController extends Controller
{
    public function index(Request $request){
        
        $data = null;
        if ($request->has('text')) {
            $author_search = DB::table('users');
            $author_search->where('status', 'active');
            $author_search->where('name', 'like', '%'.htmlspecialchars($request->input('text'), ENT_QUOTES, 'UTF-8').'%' );
            $author_search->orderBy('id', 'DESC');
            $author_search->limit(20);
            $author = $author_search->get(['id','name','avatar']);
        }else{
            $author = null;
        }
        /******************************/
        $book_search = DB::table('book');
        $book_search->where('book.status', 'active');
        
        if($request->has('text')) {
            $data['text'] = $request->input('text');
            $book_search->where('book.name', 'like', '%'.htmlspecialchars($request->input('text'), ENT_QUOTES, 'UTF-8').'%' );
        }
        
        if($request->has('category')) {
            $data['category'] = explode( ',', $request->input('category') );
        //     $book_search->join('category_book_list','category_book_list.id_book', 'book.id');
        //     // foreach($data['category'] as $rows){
        //     //     $book_search->where('category_book_list.id_category', $rows );
        //     // }
        //     $book_search->whereIn('category_book_list.id_category', $data['category'] );
        //     // $book_search->where('category_book_list.id_category', 9 );
        }

        if($request->has('free')) {
            $data['free'] = true;
            $book_search->where('book.price', 0);
        }
        
        if($request->has('type')) {
            if($request->input('type') == 'novel'){
                $data['type'] = 'novel';
                $book_search->where('book.type', 'text');
            }elseif($request->input('type') == 'shortstory'){
                $data['type'] = 'shortstory';
                $book_search->where('book.type', 'text_short');
            }elseif($request->input('type') == 'audiobook'){
                $data['type'] = 'audiobook';
                $book_search->where('book.type', 'audio');
            }
        }
        
        $book_search->groupBy('book.id');
        $book_search->orderBy('book.date', 'DESC');
        $book_search->select(['book.id','book.name','book.name_en','book.cover','book.type']);
        $book = $book_search->paginate(20);
        $category = DB::table('category_book')->where('status','active')->get(['id','sub','name','name_en']);

        return view('site.search.index',['data'=>$data,'book'=>$book,'author'=>$author,'category'=>$category]);
    }
    
    public function index_post(Request $request){
        $data['name'] = null;
        if($request->text != null){
            $data['text'] = $request->text;
        }
        if(isset($request->text)){
            $data['text'] = $request->text;
        }
        if(isset($request->type)){
            if($request->type == 'novel'){
                $name[] = 'novel';
                $data['type'] = 'novel';
            }elseif($request->type == 'shortstory'){
                $name[] = 'shortstory';
                $data['type'] = 'shortstory';
            }elseif($request->type == 'audiobook'){
                $name[] = 'audiobook';
                $data['type'] = 'audiobook';
            }
        }
        if(isset($request->free)){
            $name[] = 'free';
            $data['free'] = 'on';
        }
        if(isset($request->category)){
            $category_all = DB::table('category_book')->whereIn('id',$request->category)->where('status','active')->get(['name','name_en'])->toArray();
            foreach($category_all as $rows){
                $category[] = $rows->name_en;
            }
            $name[] = implode(",",$category);
            $data['category'] = implode(",",$request->category);
        }
        if($name != null){
            $data['name'] = implode(",",$name);
        }
        return redirect(route('site.search.index',$data));
    }
}