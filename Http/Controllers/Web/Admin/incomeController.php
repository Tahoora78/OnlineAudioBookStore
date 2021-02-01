<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class incomeController extends Controller
{


    public function index()
    {
        return view('admin.income.index');
    }

}
