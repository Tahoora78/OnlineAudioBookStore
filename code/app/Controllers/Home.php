<?php namespace App\Controllers;

use App\Models\BooksModel;

class Home extends BaseController
{
	public function index()
	{
		$BooksModel = new BooksModel;
		$book = $BooksModel->show_All();

		$time_all = $BooksModel->sum_Time()['time'];
		$views_all = $BooksModel->sum_Views()['views'];

		return view('site/home' , ['book'=>$book,'time_all'=>$time_all,'views_all'=>$views_all]);
	}

	//--------------------------------------------------------------------

}
