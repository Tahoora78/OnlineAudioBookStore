<?php namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_books','id_users','description','stars'];
    
    public function create($id_books,$id_users,$description,$stars){
        
        $data=[
          'id_books' => $id_books,
          'id_users' => $id_users,
          'description' => $description,
          'stars' => $stars,
     ];
        
        return $this->insert($data);
    }


    //--------------------------------------------------

    public function show_AllByIdBooksJoinUsers($id_books){
        return $this->where('comments.id_books', $id_books)->join('users','users.id = comments.id_users')->select(['users.name','comments.description','comments.stars'])->findAll();
    }

    public function sum_StarsByIdBooks($id_books){
        return $this->where('id_books', $id_books)->selectSum('stars')->first();
    }

}