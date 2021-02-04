<?php namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\OrdersModel;

class Orders extends BaseController
{
	public function index()
	{
		$auth = $this->auth();
		$OrdersModel = new OrdersModel;
		$book = $OrdersModel->show_AllByIdUsersJoinBooks($auth['id']);
          return view('panel/orders',['book'=>$book]);

	}

	//--------------------------------------------------------------------

}
