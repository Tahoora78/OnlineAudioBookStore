<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;
use Validator;

class blogController extends Controller
{

    public function index()
    {
        $blog = DB::table('blog')->orderBy('id','DESC')->get(['id','title','title_en','date','view','status']);
        return view('admin.blog.index',['blog'=>$blog]);
    }
    
    public function show($id)
    {
        $blog = DB::table('blog')->where('id',$id)->first();
        if(isset($blog)){
            $tags = DB::table('tag')->groupBy('key')->get(['key']);
            $tag = DB::table('tag')->where('id_post',$id)->where('type','blog')->get(['key']);
            return view('admin.blog.show',['blog'=>$blog,'tags'=>$tags,'tag'=>$tag]);
        }else{
            abort(404);
        }
    }
    
    public function create()
    {
        return view('admin.blog.create');
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'title_en' => 'required',
        ],
        [
            'title.required' => 'لطفا عنوان مقاله را وارد کنید',
            'title_en.required' => 'لطفا عنوان انگلیسی مقاله را وارد کنید',
        ]);

        if(count($validator->messages()) != 0){
           session()->put('pmError',$validator->errors()->first());
            return redirect()->route('panel.admin.blog.create');
        }else{
            $id = DB::table('blog')->insertGetId([
                'id_users'=> auth::user()->id,
                'title'=> $request->title,
                'title_en'=> $request->title_en,
                'date'=> date("Y-m-d H:i:s"),
                'view'=> 0,
                'status'=> 'deactive',
            ]);
            session()->put('pmSuccess','مقاله جدید شما ایجاد شد');
            return redirect()->route('panel.admin.blog.show',['id'=>$id]);
        }
    }
    
    public function status($id){
        $blog = DB::table('blog')->where('id',$id)->first(['status']);
        if(isset($blog)){
            if($blog->status == 'active'){
                $status = 'deactive';
            }else{
                $status = 'active';
            }
            DB::table('blog')->where('id',$id)->update([
                'status' => $status,
            ]);
            session()->put('pmSuccess','وضعیت مقاله شما تغییر یافت');
        }else{
            session()->put('pmError','همچین مقاله ای وجود ندارد');
        }
        return redirect()->route('panel.admin.blog.index');
    }
    
    public function update(Request $request,$id){
        $blog = DB::table('blog')->where('id',$id)->first(['status']);
        if(isset($blog)){
            DB::table('blog')->where('id',$id)->update([
                'title'=> $request->title,
                'title_en'=> $request->title_en,
                'meta_description'=> $request->meta_description,
                'cover'=> $request->cover,
                'context_short'=> $request->context_short,
                'context'=> $request->context,
            ]);
            DB::table('tag')->where('id_post',$id)->where('type','blog')->delete();
            if($request->tag != null){
                foreach(json_decode($request->tag) as $rows){
                    $tag[] = $rows->value;
                }
                $tag = array_unique($tag);
                foreach($tag as $rows){
                    DB::table('tag')->insert([
                        'id_post'=> $id,
                        'key'=> $rows,
                        'type'=> 'blog',
                    ]);
                }  
            }
            session()->put('pmSuccess','مقاله با موفقیت ویرایش شد'); 
        }else{
            session()->put('pmError','همچین مقاله ای وجود ندارد');
        }
        return redirect()->route('panel.admin.blog.show',['id'=>$id]);
    }
    
    public function upload()
    {
        $handle = opendir($_SERVER['DOCUMENT_ROOT'].'/images/blog');
        $images = null;
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..'){
                $images[] = $file;
            }
        }
        return view('admin.blog.upload',['images'=>$images]);
    }
    
    public function upload_post(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'image.image' => 'عکس فقط میتواند از نوع عکس باشد',
            'image.mimes' => 'فرمت عکس میتواند (jpeg,png,jpg) باشد',
            'image.max' => 'حجم عکس باید کمتر از 2 مگ باشد',
        ]);

        if(count($validator->messages()) != 0){
           session()->put('pmError',$validator->errors()->first());
        }else{
            if(isset($request->image)) {
                $imageDir = "/images/blog/";
                $imageFile = $request->file('image');
                $imageName = time().rand(1000,9999).'.'.$imageFile->getClientOriginalExtension();
                $imageIs = $imageFile->move($_SERVER["DOCUMENT_ROOT"].$imageDir, $imageName);
         
                session()->put('pmSuccess','عکس شما با موفقیت آپلود شد');
            }else{
                session()->put('pmError','لطفا عکس خود را انتخاب کنید');
            }
        }
        return redirect()->route('panel.admin.blog.upload');
    }
    
    public function upload_remove($name)
    {
        if(@is_array(getimagesize(route('site.image.index',['type'=>'blog-upload','size'=>'thumbnail','name'=>$name])))){
            $avatarDir = "/images/blog/";
            unlink($_SERVER['DOCUMENT_ROOT'].$avatarDir.$name);
            session()->put('pmSuccess','عکس انتخاب شده حذف شد'); 
        }else{
            session()->put('pmError','عکس انتخاب شده وجود ندراد');
        }
        return redirect()->route('panel.admin.blog.upload');
    }
    
}
