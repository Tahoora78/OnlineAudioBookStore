<?php

namespace App\Functions;
include_once(app_path('Functions/jdf.php'));

class Date{
    
    public function date($value){
        list($date, $time) = explode(' ', $value);

    	list($year, $month, $day) = explode('-', $date);
    
    	list($hour, $minute, $second) = explode(':', $time);
    
    	$timestamp = mktime($month, $day, $year);
    
    	return gregorian_to_jalali($year,$month,$day,'/');
    }
   
    public function time($value){
        list($date, $time) = explode(' ', $value);

    	list($year, $month, $day) = explode('-', $date);
    
    	list($hour, $minute, $second) = explode(':', $time);
    
    	return $hour.":".$minute;
    }
    
    public function jdate($format=null , $timestamp=null , $none=null , $time_zone=null , $tr_num=null){
    	return jdate( $format , $timestamp , '' , 'Asia/Tehran' , $tr_num );
    }


}



