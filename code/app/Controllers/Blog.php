<?php namespace App\Controllers;

use App\Models\BlogsModel;

class Blog extends BaseController
{
	public function index()
	{
          $BlogsModel = new BlogsModel;
		$blog = $BlogsModel->show_All();
          return view('site/blog' , ['blog'=>$blog]);
     }

     public function show($id)
	{
          $BlogsModel = new BlogsModel;
		$blog = $BlogsModel->show_AllById($id);
          if($blog){
               return view('site/blog_show',['blog'=>$blog]);
          }
          header('Location:'.base_url('blog'));
          exit;
	}

}
