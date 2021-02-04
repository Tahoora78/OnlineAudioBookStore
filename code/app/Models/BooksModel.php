<?php namespace App\Models;

use CodeIgniter\Model;

class BooksModel extends Model{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_users','title','description','price','publishers','cover','audio','time'];
    
    public function create($id_users,$title,$description,$price,$publishers,$cover,$audio,$time){
        
        $data=[
          'id_users' => $id_users,
          'title' => $title,
          'description' => $description,
          'price' => $price,
          'publishers' => $publishers,
          'cover' => $cover,
          'audio' => $audio,
          'time' => $time,
     ];
        
        return $this->insert($data);
    }
    
    
    //--------------------------------------------------

    public function update_views($id){
        return $this->where('id', $id)->increment('views');
    }
    
    public function show_AllByIdUser($id_users){
        return $this->where('id_users', $id_users)->findAll();
    }

    public function show_All(){
        return $this->findAll();
    }
    

    public function show_AllById($id){
        return $this->where('id', $id)->first();
    }

}