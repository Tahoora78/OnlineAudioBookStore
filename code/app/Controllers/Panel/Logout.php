<?php namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class Logout extends BaseController
{
	public function index()
	{
		$this->auth();
        	$session = session();
        
        	$session -> remove('login_user_id');
        	$session -> remove('login_user_name');

        	header('Location:'.base_url('/'));
        	exit;
	}

	//--------------------------------------------------------------------

}
