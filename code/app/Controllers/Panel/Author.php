<?php namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\BooksModel;

class Author extends BaseController
{
	public function index()
	{
		$auth = $this->auth();

		$BooksModel = new BooksModel;
		$book = $BooksModel->show_AllByIdUser($auth['id']);
		return view('panel/author',['book'=>$book]);
	}

	//--------------------------------------------------------------------

	public function income()
	{
		$this->auth();
		return view('panel/author_income');
	}

	//--------------------------------------------------------------------

	public function create()
	{
		$this->auth();
		return view('panel/author_create');
	}

	
}
