<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;

class reserveController extends Controller
{
    public function show()
    {
        
    }

    public function store(Request $request)
    {
        DB::table('reserve')->insert(
            [
                'national_code' => $request->national_code,
                'ip' => $request->ip,
                'date_created' => date("Y-m-d H:i:s"),
                'status' => 'active',
            ]
        );
        return [1];
    }
}
