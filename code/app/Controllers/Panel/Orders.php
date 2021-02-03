<?php namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class Orders extends BaseController
{
	public function index()
	{
		$this->auth();
    
          return view('panel/orders');

	}

	//--------------------------------------------------------------------

}
