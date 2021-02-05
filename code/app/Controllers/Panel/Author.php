<?php namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\OrdersModel;

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
		$auth = $this->auth();

		$BooksModel = new BooksModel;
		$OrdersModel = new OrdersModel;
		$book = $BooksModel->show_AllByIdUser($auth['id']);

		$chrt_x = [];
		$chrt_y = [];
		$price_all = 0;
		foreach($book as $rows){
			$chrt_x[$rows['id']] = '"'.$rows['title'].'"';
			$sum_price = $OrdersModel ->sum_PriceByIdBooks($rows['id']);
			$chrt_y[$rows['id']] = '"'.$sum_price['price'].'"';
			$price_all += $sum_price['price'];
		}

		$time_all = $BooksModel->sum_TimeByIdUsers($auth['id'])['time'];
		$views_all = $BooksModel->sum_ViewsByIdUsers($auth['id'])['views'];
		$orders_all = $BooksModel->sum_JoinOrderByIdUsers($auth['id']);
		return view('panel/author_income',['chrt_x'=>$chrt_x,'chrt_y'=>$chrt_y,'price_all'=>$price_all,'time_all'=>$time_all,'views_all'=>$views_all,'orders_all'=>$orders_all]);
	}

	//--------------------------------------------------------------------

	public function create()
	{
		$this->auth();
		return view('panel/author_create');
	}

	public function store()
	{
		$session = session();
		$auth = $this->auth();

		$title = $_POST['title'];
		$time = $_POST['time'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$publishers = $_POST['publishers'];
		$cover = $this->request->getFile('cover');
		$audio = $this->request->getFile('audio');

		$coverNewName = $cover->getRandomName();
		$cover->move($_SERVER['DOCUMENT_ROOT'].getenv('app.baseDirUpload').'/upload/cover',$coverNewName);

		$audioNewName = $audio->getRandomName();
	    	$audio->move($_SERVER['DOCUMENT_ROOT'].getenv('app.baseDirUpload').'/upload/audio',$audioNewName);

		$BooksModel = new BooksModel;
		$id_book = $BooksModel->create($auth['id'],$title,$description,$price,$publishers,$coverNewName,$audioNewName,$time);

		$session->set(['pm' => ['success','کتاب شما با موفقیت ایجاد شد']]);
		header('Location:'.base_url('panel/author/'));
		exit;

	}
}
