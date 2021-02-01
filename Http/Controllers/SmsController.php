<?php

namespace App\Http\Controllers;

use DB;
use SoapClient;

class SmsController extends Controller
{

    public function send($mobile,$data,$pattern)
    {   
        $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl"); 
        $user = "zajkaniha"; 
        $pass = "m134679258m"; 
        $fromNum = "+985000125475"; 
        // $fromNum = "+983000505"; 
        $toNum = $mobile; 
        $pattern_code = $pattern; 
        $input_data = $data;
        return $client ->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
    }
   
}
