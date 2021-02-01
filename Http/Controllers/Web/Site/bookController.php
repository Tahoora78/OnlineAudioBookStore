<?php

namespace App\Http\Controllers\Web\Site;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Functions\Site;
use App\Http\Controllers\PayController;
use Illuminate\Http\Request;


class bookController extends Controller
{
    
    public function show($id){ 
        $book = DB::table('book')->where('id',$id)->where('status','active')->first();
        if(isset($book)){
            $users = DB::table('users')->where('id',$book->id_users)->first(['id','name','avatar']);
            
            if(Auth::guest()){
                $order_book = null;
            }else{
                $order_book = DB::table('order_book')->where('id_users', auth::user()->id)->where('id_book',$id)->first();
            }
            
            $category_all = DB::table('category_book_list')->where('category_book_list.id_book',$id)->join('category_book','category_book.id','category_book_list.id_category')->where('category_book.status','active')->get(['category_book.name']);
            if(count($category_all)!=0){
                $category = $category_all[0]->name;
            }else{
                $category = 'بدون دسته';
            }
           
            DB::table('book')->where('id', $book->id)->update([
            'view' => $book->view + 1,
            ]);
            
            $Functions = new Site();
            $Functions->view_users($book->id_users);
            
            if(Auth::guest()){
                $favourite = false;
            }else{
                if(auth::user()->favourite == null){
                    $favourite = false;
                }elseif(in_array($id, json_decode(auth::user()->favourite,true))){
                    $favourite = true;
                }else{
                    $favourite = false;
                } 
            }
            
            $book_season = DB::table('book_season')->where('id_book',$id)->where('status_publish','completed')->where('status','active')->count(); 
            
            $page = DB::table('book_season')->where('id_book',$id)->where('status_publish','completed')->where('status','active')->sum('page'); 

            
            $comment = DB::table('comment_book')->where('comment_book.id_book', $book->id)->where('comment_book.context', '!=', null)->where('comment_book.status', 'active')->join('users','users.id','comment_book.id_users')->get(['comment_book.context','users.id','users.name','users.avatar']);
            
            $comment_count_star[1] = DB::table('comment_book')->where('id_book', $book->id)->where('status', 'active')->where('star',1)->count();
            $comment_count_star[2] = DB::table('comment_book')->where('id_book', $book->id)->where('status', 'active')->where('star',2)->count();
            $comment_count_star[3] = DB::table('comment_book')->where('id_book', $book->id)->where('status', 'active')->where('star',3)->count();
            $comment_count_star[4] = DB::table('comment_book')->where('id_book', $book->id)->where('status', 'active')->where('star',4)->count();
            $comment_count_star[5] = DB::table('comment_book')->where('id_book', $book->id)->where('status', 'active')->where('star',5)->count();
            $comment_count_star['total'] = $comment_count_star[1]+$comment_count_star[2]+$comment_count_star[3]+$comment_count_star[4]+$comment_count_star[5];
            $comment_sum_star['total'] = DB::table('comment_book')->where('id_book', $book->id)->where('status', 'active')->sum('star');

            if(isset($book->category_sub)){
                $category_sub = DB::table('category_book')->where('id',$book->category_sub)->first(['name'])->name;
            }else{
                $category_sub = null;
            }
            
            return view('site.book.show', ['book'=>$book, 'users'=>$users, 'favourite'=>$favourite,'book_season'=>$book_season,'page'=>$page,'category'=>$category, 'order_book'=>$order_book, 'category_sub'=>$category_sub, 'comment'=>$comment,'comment_count_star'=>$comment_count_star,'comment_sum_star'=>$comment_sum_star]);
        }
        abort(404);
    }
    
    public function study($id){
        
        $book = DB::table('book')->where('id',$id)->where('status','active')->first();
        if(isset($book)){
            $book_season = DB::table('book_season')->where('id_book',$id)->where('season',1)->where('status_publish','completed')->where('status','active')->count(); 
            if($book_season >= 1){
                $filename = $_SERVER['DOCUMENT_ROOT']."/../book_text/".$book->id."/1/1.txt";
                $fp = fopen($filename, "r");
                if(filesize($filename) != 0){
                    $content = fread($fp, filesize($filename));
                }else{
                    $content = '';
                }
                $lines = explode("\n", $content);
                fclose($fp);
                $content = nl2br(implode("\n", $lines));
                return view('site.book.study',['book'=>$book,'content'=>$content]);
            }
        }
        abort(404);
    }
    
    public function favourite($id){
        $book = DB::table('book')->where('id',$id)->first(['id','name','name_en']);
        if(isset($book)){
            $favourite = json_decode(auth::user()->favourite,true);
            if($favourite == null){
                $favourite[] = $id;
                $favourite_new = json_encode($favourite);
                session()->put('pmSuccess','کتاب به لیست مورد علاقه شما اضافه شد');
            }elseif(in_array($id, $favourite)){
                unset($favourite[array_search($id, $favourite)]);
                if(count($favourite)==0){
                  $favourite_new = null;  
                }else{
                    $favourite_new = json_encode($favourite);
                }
                session()->put('pmSuccess','کتاب از لیست مورد علاقه شما حذف شد');
            }else{
                $favourite[] = $id;
                $favourite_new = json_encode($favourite);
                session()->put('pmSuccess','کتاب به لیست مورد علاقه شما اضافه شد');
            }
            DB::table('users')->where('id',auth::user()->id)->update([
                'favourite' => $favourite_new,
            ]);
            return redirect()->route('site.book.show', ['id'=>$book->id,'name'=>str_replace(' ', '-', $book->name_en)]);
        }
        abort(404);
    }
    
    public function pay(Request $request, $id){
        $book = DB::table('book')->where('id',$id)->where('status','active')->first(['price', 'type']);
        if(!isset($book)){
            abort(404);
        }
        $order_book = DB::table('order_book')->where('id_users', auth::user()->id)->where('id_book',$id)->first();
        if(isset($order_book)){
            abort(404);
        }
        if($book->price==0){
            $order_book = DB::table('order_book')->insertGetId([
                        'id_users' => Auth::user()->id,
                        'id_book' => $id,
                        'mark' => null,
                        'date' =>  date("Y-m-d H:i:s"),
                        'status' => 'active',
                    ]);
            if($book->type=='audio'){
                return redirect()->route('panel.bookaudio.index');
            }else{
                return redirect()->route('panel.book.index');
            }
        }elseif($book->price<1000){
            abort(404);
        }
        $pay = new PayController();
        if(config('constants.offer')['percent'] != 0){
            $price = ((100-config('constants.offer')['percent'])*$book->price)/100;
        }else{
            $price =$book->price;
        }
        $id_financial = DB::table('financial')->insertGetId([
                                'id_users' => Auth::user()->id,
                                'type' => 'book',
                                'value' => $id,
                                'price' => $price,
                                'date' =>  date("Y-m-d H:i:s"),
                                'status' => 'unpaid',
                            ]);
        $pay->send( $price ,'pep', $id_financial , route('site.book.verify') , 'خرید کتاب' , auth::user()->email , auth::user()->mobile);
    }
    
    public function verify(Request $request){
        if($request->input('id') and $request->input('Authority') ){
            $financial = DB::table('financial')->where('id',$request->input('id'))->where('id_users', auth::user()->id)->where('status', 'unpaid')->first();
                if(isset($financial)){
                    if($request->input('Status') == 'OK'){
                        
                        $pay = new PayController();
                        if($pay->verify($financial->price,$request->input('Authority')) == false){
                            session()->put('pmError','مشکل امنیتی در پرداخت');
                            return redirect()->route('panel.financial.index');
                        }
                        
                        $book = DB::table('book')->where('id', $financial->value)->first(['id_users','type']);
                        
                        $author = DB::table('users')->where('id', $book->id_users)->first(['percent']);
                        if($author->percent != null){
                            $percent = $author->percent;
                        }else{
                            $percent = 70;
                        }
                        
                        DB::table('financial')->where('id',$request->input('id'))->update([
                            'authority' => $request->input('Authority'),
                            'date_paid' => date("Y-m-d H:i:s"),
                            'price_author' => (($financial->price*$percent)/100),
                            'percent_author' => $percent,
                            'status_author' => 'unpaid',
                            'status' => 'paid',
                        ]);
                        $order_book = DB::table('order_book')->insertGetId([
                            'id_users' => Auth::user()->id,
                            'id_book' => $financial->value,
                            'mark' => null,
                            'date' =>  date("Y-m-d H:i:s"),
                            'status' => 'active',
                        ]);
                        //pmSuccess
                        session()->put('pmSuccess','پرداخت شما با موفقیت انجام شد');
                        
                        if($book->type=='audio'){
                            return redirect()->route('panel.bookaudio.index');
                        }else{
                            return redirect()->route('panel.book.index');
                        }
                    }else{
                        DB::table('financial')->where('id',$request->input('id'))->delete();
                    }
                }else{
                   //pmError
                }
        }else{
         //pmError
        }
        session()->put('pmError','پرداخت شما انجام نشد');
        return redirect()->route('panel.financial.index');
    }
    
}