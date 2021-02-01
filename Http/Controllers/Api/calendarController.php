<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;

include_once(app_path('Functions/jdf.php'));

class calendarController extends Controller
{
    public function year()
    {
        $year=$_GET['year'];
        $day=1;

        $date_holiday_shamsi = config('constants.date_holiday_shamsi');
        $date_holiday_qamari = config('constants.date_holiday_qamari');
        $date_monasebat_shamsi = config('constants.date_monasebat_shamsi');

        for($m=1;$m<=12;$m++){

                $month=$m;
                $jmktime = jmktime(0,0,0,$month,$day,$year);// خروجی: 1297392334
                $all_day_month = jdate('t',$jmktime,'','','en');
                $name_month = jdate('F',$jmktime,'','','en');
                $b = 0;

                $monthArray[$month]['week'][0][0] = null;
                $monthArray[$month]['week'][0][1] = null;
                $monthArray[$month]['week'][0][2] = null;
                $monthArray[$month]['week'][0][3] = null;
                $monthArray[$month]['week'][0][4] = null;
                $monthArray[$month]['week'][0][5] = null;
                $monthArray[$month]['week'][0][6] = null;


                for($i=1;$i<=$all_day_month;$i++){
                    $week_day = jdate('w',jmktime(0,0,0,$month,$i,$year),'','','en');

                    if (isset($date_monasebat_shamsi[$month.'/'.$i])) {
                        $monthArray[$month]['week'][$b][$week_day]['monasebat'] = $date_monasebat_shamsi[$month.'/'.$i];
                    }

                    $shamsi = jdate('j',jmktime(0,0,0,$month,$i,$year),'','','en');
                    $monthArray[$month]['week'][$b][$week_day]['jmktime'] = jmktime(0,0,0,$month,$i,$year);
                    $monthArray[$month]['week'][$b][$week_day]['shamsi'] = $shamsi;
                    $monthArray[$month]['week'][$b][$week_day]['miladi'] = date('d',jmktime(0,0,0,$month,$i,$year));
                    $monthArray[$month]['week'][$b][$week_day]['qamari'] = 0;

                    if (isset($date_holiday_shamsi[$month.'/'.$shamsi]) or $week_day==6) {
                        $monthArray[$month]['week'][$b][$week_day]['holiday'] = true;
                    }

                    if($week_day == 6){
                        $b++;
                    }

                }

                for($i=0;$i<=6;$i++){
                    if(!isset($monthArray[$month]['week'][4][$i])){
                    $monthArray[$month]['week'][4][$i] = null;
                    }
                    if(!isset($monthArray[$month]['week'][5][$i])){
                    $monthArray[$month]['week'][5][$i] = null;
                    }
                }

                // for($i=0;$i<=6;$i++){
                //   if(!isset($monthArray[$month]['week'][count($monthArray[$month]['week'])-1][$i])){
                //     $monthArray[$month]['week'][count($monthArray[$month]['week'])-1][$i] = null;
                //   }
                // }

                $monthArray[$month]['name'] = $name_month;
                $monthArray[$month]['all_day_month'] = $all_day_month;
        }

        $arrayJson = [
        'year' => $year,
        'month' => $monthArray
        ];

        $code=200;
        
        return response()->json($arrayJson,$code);
    }

    public function month()
    {
   
    }


}
