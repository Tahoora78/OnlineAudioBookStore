<?php namespace App\Models;

use CodeIgniter\Model;

class BlogsModel extends Model{
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','description','thumbnail'];
    
    public function create($title,$description,$thumbnail){
        
        $data=[
          'title' => $title,
          'description' => $description,
          'thumbnail' => $thumbnail,
        ];
        
        return $this->insert($data);
    }
    
    
    //--------------------------------------------------

    public function show_All(){
        return $this->findAll();
    }
    

    public function show_AllById($id){
        return $this->where('id', $id)->first();
    }

    //--------------------------------------------------

    public function update_ThumbnailById($id,$thumbnail)
    {
        $data = [
            'thumbnail' => $thumbnail,
        ];
        return $this->where('id', $id)->set($data)->update();
    }


    public function update_AllById($id,$title,$description)
    {
        $data=[
            'title' => $title,
            'description' => $description,
          ];
        return $this->where('id', $id)->set($data)->update();
    }

}