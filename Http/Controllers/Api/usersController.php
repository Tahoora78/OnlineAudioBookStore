<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Illuminate\Support\Facades\Hash;


class usersController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        return $users;
    }


    public function show($id)
    {
        $users = DB::table('users')->where('id',$id)->get();
        return $users;
    }

    public function update(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'phone' => $request->phone,
        ]);
    }

    public function store(Request $request)
    {
        DB::table('users')->insert(
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'national_code' => $request->national_code,
                'password' => Hash::make($request->password),
                'ip' => $request->ip,
                'reagent' => $request->reagent,
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'remember_token' => null,
                'status' => 'active',
            ]
        );
        return [1];
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return 1;
    }
   
}
