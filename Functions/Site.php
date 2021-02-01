<?php

namespace App\Functions;

use DB;
use Auth;
use App\Functions\Date;

class Site{
    
    public function view_users($id){
        $users = DB::table('users')->where('id',$id)->first();
        $view = json_decode($users->view,true);
        $Functions_Date = new Date();
        $year_now = $Functions_Date->jdate("Y",time(), null , null , 'en');
        $month_now = $Functions_Date->jdate("n",time(), null , null , 'en');
        
        if($view==null){  //$view null bod
            $view[$year_now] = [1=>0 ,2=>0 ,3=>0 ,4=>0 ,5=>0 ,6=>0 ,7=>0 ,8=>0 ,9=>0 ,10=>0 ,11=>0 ,12=>0];
            $view[$year_now][$month_now] = 1;
            DB::table('users')->where('id',$id)->update([
                'view' => json_encode($view)
            ]);
        }elseif(!isset($view[$year_now])){ //$view sal bod
            $view[$year_now] = [1=>0 ,2=>0 ,3=>0 ,4=>0 ,5=>0 ,6=>0 ,7=>0 ,8=>0 ,9=>0 ,10=>0 ,11=>0 ,12=>0];
            $view[$year_now][$month_now] = 1;
            DB::table('users')->where('id',$id)->update([
                'view' => json_encode($view),
            ]);
        }else{ //$view ++
            $view[$year_now][$month_now] = $view[$year_now][$month_now] + 1;
            DB::table('users')->where('id',$id)->update([
                'view' => json_encode($view),
            ]);
        }

    }
    
    public function view_users_reset($id){
        $users = DB::table('users')->where('id',$id)->first();
        $view = json_decode($users->view,true);
        $Functions_Date = new Date();
        $year_now = $Functions_Date->jdate("Y",time(), null , null , 'en');
        $month_now = $Functions_Date->jdate("n",time(), null , null , 'en');
        if(!isset($view[$year_now])){ //$view sal bod
            $view[$year_now] = [1=>0 ,2=>0 ,3=>0 ,4=>0 ,5=>0 ,6=>0 ,7=>0 ,8=>0 ,9=>0 ,10=>0 ,11=>0 ,12=>0];
            $view[$year_now][$month_now] = 1;
            DB::table('users')->where('id',$id)->update([
                'view' => json_encode($view),
            ]);
        }
    }

}



