<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;

class SubscriptionController extends Controller
{
      public function purchase(Request $request)
        {
            // Requestten gelen verilerin doğruluğunu kontrol etme
            $this->validate($request, [
                'productId' => 'required|string',
                'receiptToken' => 'required|string', // receiptToken, satın alma işleminin kimlik doğrulaması için kullanılan token
            ]);

     
        // Gelen token bilgisini kullanıyoruz. receiptToken satın alma işlemi sırasında users tablosuna kaydedildi olarak varsayıyorum. bunun için migrationda alan oluşturdum zaten. device kısmına da user_id ekledim. buradan cihaz ve kullanıcıyı eşleştireceğiz.
            $user = User::where("receipt_token",$request->receiptToken)->first();


            //Eğer kullanıcı bulunamazsa hata dönelim.
            if (!$user) {
                return response()->json([
                    "status"=>false,
                    "message"=>"Kullanıcı bulunamadı."
                ]);
            }

            //Kullanıcı var ve satın alma başarılıysa cihaz ile kullanıcıyı eşleyelim.
            $update_device = Device::where("receipt_token",$request->receiptToken)->update([
                "user_id"=>$user_id
            ]);


            // Verileri oluşturyoruz.
            $subscriptionInfo = [
                'productId' => $request->productId,
                'status' => 'active',  
            ];

            // Kullanıcı yanıtı
            return response()->json($subscriptionInfo);









            // Abonelik bilgilerini belirleyin
            $subscriptionInfo = [
                'productId' => $request->input('productId'),
                'status' => 'active', // Abonelik durumu veya diğer gerekli bilgileri ayarlayın
            ];

            // Kullanıcıya abonelik bilgilerini dönün
            return response()->json($subscriptionInfo);
        }
}
