<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{

    public function send($title,$email,$name,$text){       
        $data = array('title'=>$title,'name'=>$name,'text'=>$text);     
        Mail::send('layouts.mail.app', $data, function($message) use ($title,$email,$name){         
            $message->to($email, $name)->subject($title);
            $message->from('Bot@romankhan.com','رمان خوان');
        });       
        return true;
        
    }  
    
    public function attachment(){       
        $data = array('name'=>"Virat Gandhi");       
        Mail::send('mail', $data, function($message) {          
            $message->to('abc@gmail.com', 'Tutorials Point')->subject('Laravel Testing Mail with Attachment');          
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');          
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');          
            $message->from('info@romankhan.com','roman khan');
        });
        echo "Email Sent with attachment. Check your inbox.";    
    }
}