<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceInformationController extends Controller
{
    public function getDeviceInformation(Request $request)
    { 

        // Kullanıcının hangi cihazdan giriş yaptığını alıyoruz
        $device = $request->header('User-Agent');


        //Device Bilgilerini Veritabanına kaydediyoruz.
        $insert = Device::insert([
            "device_name" => $device
        ]);


        // İnsert işleminin başarı durumuna göre işlem yapıyoruz.
        if ($insert) {

            // Premium durumunu kontrol ediyoruz.
            $premiumStatus = true; 


            // Config bilgilerini ayarlıyoruz.
             $config = [
                'premium' => true, 
            ]; // Config bilgileri

            // Kullanıcıya premium durumu ve config bilgilerini dönüyoruz
            return response()->json([
                'status'=>true,
                'premium' => $premiumStatus,
                'config' => $config,
            ]); 
        }else{
            return response()->json([
                "status"=>true,
                "message"=>"İşlem sırasında bir hata oluştu"
            ]);
        }


  
    }
}
