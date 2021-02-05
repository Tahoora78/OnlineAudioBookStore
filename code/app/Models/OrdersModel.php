<?php namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_users','id_books','price'];
    
    public function create($id_users,$id_books,$price){
        
        $data=[
          'id_users' => $id_users,
          'id_books' => $id_books,
          'price' => $price,
     ];
        
        return $this->insert($data);
    }
    
    
    //--------------------------------------------------

     public function show_AllByIdUsersIdBooks($id_users,$id_books){
        return $this->where('id_users', $id_users)->where('id_books', $id_books)->first();
     }

     public function show_AllByIdUsersJoinBooks($id_users){
          return $this->where('orders.id_users', $id_users)->join('books','orders.id_books = books.id')->select(['books.id','books.title','books.cover'])->findAll();
     }
     
     //--------------------------------------------------

	public function sum_PriceByIdBooks($id_books){
		return $this->where('id_books', $id_books)->selectSum('price')->first();
	 }

}