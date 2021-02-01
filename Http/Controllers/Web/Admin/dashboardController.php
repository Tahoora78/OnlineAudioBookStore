<?php
namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use DB;
 
    
class dashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }
    
}