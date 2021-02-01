<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use DB;
use Auth;

class financialController extends Controller
{
    
    public function index(){
        $financial = DB::table('financial')->where('id_users', auth::user()->id)->orderBy('date','DESC')->get();        
        return view('panel.financial.index',['financial'=>$financial]);
    }
    
}