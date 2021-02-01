<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{


    public function index()
    {
        $users = DB::table('users')->orderBy('id', 'DESC')->get();
        return view('admin.users.index',['users'=>$users]);
    }

}
