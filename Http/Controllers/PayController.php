<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use DB;
use SoapClient;

class PayController extends Controller
{

    public function send($Amount,$Bank=null,$id=null,$Back,$Description=null,$Email=null,$Mobile=null)
    {   
     
        if($Bank == 'Asan'){
            $Gate = 'Asan';  
        }elseif($Bank == 'Pep'){
            $Gate = 'Pep'; 
        }elseif($Bank == 'Mca'){
            $Gate = 'Mca'; 
        }elseif($Bank == 'Pec'){
            $Gate = 'Pec';
        }elseif($Bank == 'Pna'){
            $Gate = 'Pna';
        }elseif($Bank == 'Ikc'){
            $Gate = 'Ikc';
        }else{
            // $Gate = 'ZarinGate';  
            $Gate = 'Pec';  
        }
        
        $MerchantID = 'ef940afa-7911-11ea-815d-000c295eb8fc'; //Required
        $Amount = $Amount; //Amount will be based on Toman - Required
        $Description = $Description; // Required
        $Email = $Email; // Optional
        $Mobile = $Mobile; // Optional
        $CallbackURL = $Back.'?id='.$id; // Required
        
        
        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        
        $result = $client->PaymentRequest(
        [
        'MerchantID' => $MerchantID,
        'Amount' => $Amount,
        'Description' => $Description,
        'Email' => $Email,
        'Mobile' => $Mobile,
        'CallbackURL' => $CallbackURL,
        ]
        );
      
        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
        //برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
         Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/'.$Gate);
        } else {
        echo'ERR: '.$result->Status;
        }
        
    }


    public function verify($price,$Authority_id)
    {
       
        $MerchantID = 'ef940afa-7911-11ea-815d-000c295eb8fc';
        $Amount = $price; //Amount will be based on Toman
        $Authority = $Authority_id;
    
        
        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        
        $result = $client->PaymentVerification(
        [
        'MerchantID' => $MerchantID,
        'Authority' => $Authority,
        'Amount' => $Amount,
        ]
        );
        
        if ($result->Status == 100) {
            return true;
        }else{
            return false;
        }
    }

   
}
