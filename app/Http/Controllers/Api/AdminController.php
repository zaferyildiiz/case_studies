<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Device;

class AdminController extends Controller
{
    public function index()
    {
        //DEvice tablosundaki verileri user tablosuyla eşleyerek çekiyoruz.
        // bunun için device modelinde belongsto kullandık.
        //misafir girişi olmaması ve güvenlik açısından ISadmin ve auth middlewarelarını api.php rotasına ekledik.
        $devices = Device::with('user')->get();


        //Eğer hiçbir kayıt yoksa ;
        if ($device->count() == 0) {
            return response()->json([
                "status"=>false,
                "message"=>"Kayıt bulunamadu"
            ]);
        }




        //Eğer kayıt varsa olduğu gibi json olarak gönderiyoruz. front ve mobil tarafta gerekli işlemler yapılır.

        return response()->json([
            "status"=>true,
            "data"=>json_encode($device)
        ]);



    }
}
