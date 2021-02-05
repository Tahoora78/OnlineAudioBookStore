<?php namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\BlogsModel;

class Blog extends BaseController
{

     function __construct() {
          $auth = $this->auth();
          if($auth['id'] != 23){
               header('Location:'.base_url('panel'));
		     exit;
          }
     }

     //--------------------------------------------------------------------

	public function index()
	{
		$auth = $this->auth();
		$BlogsModel = new BlogsModel;
          $blog = $BlogsModel->show_All();
          return view('panel/blog',['blog'=>$blog]);
	}

	
     //--------------------------------------------------------------------
     
     public function edit($id)
	{
          $this->auth();
          $BlogsModel = new BlogsModel;
		$blog = $BlogsModel->show_AllById($id);
          if($blog){
               return view('panel/blog_edit',['blog'=>$blog]);
          }
          header('Location:'.base_url('panel/blog'));
          exit;
     }
     

     public function update($id)
	{
          $this->auth();
          $session = session();
          
          $BlogsModel = new BlogsModel;
          $blog = $BlogsModel->show_AllById($id);
          
          if(!$blog){
               header('Location:'.base_url('panel/blog'));
               exit;
          }

          $title = $_POST['title'];
		$description = $_POST['description'];
          $thumbnail = $this->request->getFile('thumbnail');

          if($thumbnail->isValid()){
               unlink($_SERVER['DOCUMENT_ROOT'].getenv('app.baseDirUpload').'/upload/blog/'.$blog['thumbnail']); 
               $thumbnailNewName = $thumbnail->getRandomName();
               $thumbnail->move($_SERVER['DOCUMENT_ROOT'].getenv('app.baseDirUpload').'/upload/blog',$thumbnailNewName);
               $BlogsModel->update_ThumbnailById($id,$thumbnailNewName);
          }

		$id_Blog = $BlogsModel->update_AllById($id,$title,$description);

		$session->set(['pm' => ['success','بلاگ شما با موفقیت ویرایش شد']]);
		header('Location:'.base_url('panel/blog/'));
		exit;
	}

     //--------------------------------------------------------------------

	public function create()
	{
		$this->auth();
		return view('panel/blog_create');
	}

	public function store()
	{
		$session = session();
		$auth = $this->auth();

		$title = $_POST['title'];
		$description = $_POST['description'];
		$thumbnail = $this->request->getFile('thumbnail');

		$thumbnailNewName = $thumbnail->getRandomName();
		$thumbnail->move($_SERVER['DOCUMENT_ROOT'].getenv('app.baseDirUpload').'/upload/blog',$thumbnailNewName);

	
		$BlogsModel = new BlogsModel;
		$id_Blog = $BlogsModel->create($title,$description,$thumbnailNewName);

		$session->set(['pm' => ['success','بلاگ شما با موفقیت ایجاد شد']]);
		header('Location:'.base_url('panel/blog/'));
		exit;

	}
}
