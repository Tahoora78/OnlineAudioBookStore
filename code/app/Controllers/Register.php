<?php namespace App\Controllers;

use App\Models\UsersModel;

class Register extends BaseController{
    
    public function index(){
        $session = session();
        if( $session->has('login_user_id') ){
            header('Location:'.base_url('panel/'));
            exit;
        }

        return view('site/register');
    }
    
    
    //--------------------------------------------------

    public function create(){
        $session = session();
        
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if($name==null or $username==null or $password==null){
            $session->set(['pm' => ['error','لطفا اطلاعات ثبت نام را تکمیل کنید']]);
            header('Location:'.base_url('/register'));
            exit;
        }
        
        $UsersModel = new UsersModel;
        
        $check_username = $UsersModel->check_username($username);
        
        if($check_username){
            $session->set(['pm' => ['error','اطلاعات وارد شده صحیح نمیباشد.']]);
            header('Location:'.base_url());
            exit;
        }

        $newUser = $UsersModel->create($name,$username,$password);

        $data = [
            'login_user_id' => $newUser,
            'login_user_name' => $username,
        ];
        $session->set($data);
        $session->set(['pm' => ['success','با موفقیت وارد شدید']]);
        header('Location:'.base_url('panel/'));
        exit;
    }
    

}