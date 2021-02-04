<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','password','username'];
    
    public function create($name,$username,$password){
        
        $data=[
            'name' => $name,
            'username' => $username,
            'password' => password_hash($password,PASSWORD_DEFAULT),
        ];
        
        return $this->insert($data);
    }
    
    
    //--------------------------------------------------

    
    public function check_login($username,$password){
        $user = $this->where('username', $username)->first();
        if($user){
            return password_verify($password, $user['password']) ? $user : false;
        }else{
            return false;
        }
    }
    
    
    //--------------------------------------------------

    
    public function check_username($username){
        return $this->where('username', $username)->select(['id'])->first();
    }
    
    //--------------------------------------------------


    public function show_nameById($id){
        return $this->where('id', $id)->select(['name'])->first();
    }

}