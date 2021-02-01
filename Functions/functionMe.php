<?php

namespace App\Functions;

use DB;
use Auth;


class functionMe{
    
 
    public function count_context($text){
        $a = count(explode(" ",$text));
        $b = count(explode("\n",$text));
        return $a+$b;
    }

}



