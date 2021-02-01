<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;

class placeController extends Controller
{
    public function index()
    {
        
        if(request('id_users')){ //http://marasem.top/api/salam/place?id_users=1
            $data = DB::table('place')->where('id_users',request('id_users'))->get(['id','type','title','city','province']);
            if($data){
                foreach($data as $key=>$rows){
                $data[$key]->city_title = config('constants.province')[$rows->province]['city'][$rows->city]['title'];
                $data[$key]->province_title = config('constants.province')[$rows->province]['title'];
                $data[$key]->type_title = config('constants.type_place')[$rows->type]['title'];
                }
                $code = 200;
            }else{
              $code = 404;
            }
        }elseif(request('username')){ //http://marasem.top/api/salam/place?username=aaa
            $data = DB::table('place')->where('username',request('username'))->first();
            if($data){
                $data->city_title = config('constants.province')[$data->province]['city'][$data->city]['title'];
                $data->province_title = config('constants.province')[$data->province]['title'];
                $data->type_title = config('constants.type_place')[$data->type]['title'];
                $code = 200;
            }else{
                $code = 404;
            }
        }else{
            $data = [0] ;
            $code = 400;
        }
        return response()->json($data,$code);
    }


    public function show($id)
    {
        $data = DB::table('place')->where('id',$id)->first();
        $data->city_title = config('constants.province')[$data->province]['city'][$data->city]['title'];
        $data->province_title = config('constants.province')[$data->province]['title'];
        $data->type_title = config('constants.type_place')[$data->type]['title'];
        (($data) ? $code = 200 : $code = 404 );
        return response()->json($data,$code);
    }


    public function update(Request $request, $id)
    {
        DB::table('place')->where('id', $id)->update([
            'description' => $request->description,
            'icon' => $request->icon,
            'banner' => $request->banner,
            'gallery_photo' => $request->gallery_photo,
            'gallery_video' => $request->gallery_video,
            'gallery_download' => $request->gallery_download,
            'entrance' => $request->entrance,
            'hall' => $request->hall,
            'package' => $request->package,
            'map' => $request->map,
        ]);
    }

    public function store(Request $request)
    {
        DB::table('place')->insert(
            [
                'id_users' => $request->id_users,
                'type' => $request->type,
                'title' => $request->title,
                'province' => $request->province,
                'city' => $request->city,
                'date_created' => date("Y-m-d H:i:s"),
                'date_expiry' => date("Y-m-d H:i:s", strtotime("+14 day")),
                'status' => 'active',
            ]
        );
        return [1];
    }

    public function date_extend()
    {

        DB::table('place')->where('id', $id)->update([
            'date_expiry' => date("Y-m-d H:i:s", strtotime("+14 day")),
            'status' => 'active',
        ]);
    }
     
    public function date_expiry()
    {

        DB::table('place')->where('id', $id)->update([
            'status' => 'deactive',
        ]);
    }

    public function search(Request $request)
    {
        $data = DB::table('place')->where('province',$request->province)->where('city',$request->city)->where('type',$request->place)->first();
        if($data){
            $data->city_title = config('constants.province')[$data->province]['city'][$data->city]['title'];
            $data->province_title = config('constants.province')[$data->province]['title'];
            $data->type_title = config('constants.type_place')[$data->type]['title'];
            $code = 200;
        }else{
            $code = 404;
        }
        return response()->json($data,$code);
    }
}