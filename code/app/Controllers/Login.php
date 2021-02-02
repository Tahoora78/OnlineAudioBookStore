<?php namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController{
    
    public function index(){
        $session = session();
        if( $session->has('login_user_id') ){
            header('Location:'.base_url('panel/'));
            exit;
        }

        return view('site/login');
    }
    
    
    //--------------------------------------------------

    public function check(){
        $session = session();
        
        $username = $_POST['username'];
        $password = $_POST['password'];
      
        
        if($username==null or $password==null){
            $session->set(['pm' => ['error','لطفا اطلاعات ورود را وارد کنید']]);
            header('Location:'.base_url('login'));
            exit;
        }
        
        $UsersModel = new UsersModel;
        
        $check_login = $UsersModel->check_login($username,$password);
        
        if($check_login == false){
            $session->set(['pm' => ['error','اطلاعات وارد شده صحیح نمی باشد.']]);
            header('Location:'.base_url('login'));
            exit;
        }

        $data = [
            'login_user_id' => $check_login['id'],
            'login_user_name' => $check_login['name'],
        ];

        $session->set($data);
        $session->set(['pm' => ['success','با موفقیت وارد شدید']]);
        header('Location:'.base_url('panel/'));
        exit;
            
        
    }
    
}