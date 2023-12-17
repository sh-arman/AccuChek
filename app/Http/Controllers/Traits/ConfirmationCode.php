<?php

namespace App\Http\Controllers\Traits;

use SoapClient;
use App\Models\User;
use App\Models\Activation;
use Illuminate\Support\Facades\Log;

trait ConfirmationCode
{


    public function ConfirmationCode($userId)
    {
        if ($userId == null) $userId = session('userId');
        $user = User::find($userId);

        $activation = Activation::create([
            'user_id' => $user->id,
            'otp' => $this->generateOTP()
        ]);

        $message = "Shaheen Food Check OTP: " . " " . $activation->otp;
        return $this->SendSms($user->phone_number, $message);
    }



    public function SendSms($phoneNo, $message)
    {
        try {
            $soapClient = new SoapClient("https://user.mobireach.com.bd/index.php?r=sms/service");
            $soapClient->SendTextMessage('panacealive', 'Panacearocks@2022', 'MAXPRO', $phoneNo, $message);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            Log::info("Shaheen Food Check OTP :" . $e->getMessage());
        }
    }

    private function generateOTP()
    {
        $an = "0123456789";
        $su = strlen($an) - 1;
        $otp = substr($an, rand(0, $su), 1) .
               substr($an, rand(0, $su), 1) .
               substr($an, rand(0, $su), 1) .
               substr($an, rand(0, $su), 1);
        return $otp;
    }
}







// public function SendSms($phone_number, $message, $mask = 'Panacea')
// {
//     try {
//         $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
//         $paramArray = array('userName' => "01675430523",
//             'userPassword' => "tapos99", 'mobileNumber' => $phone_number,
//             'smsText' => $message, 'type' => "TEXT",
//             'maskName' => "Panacea", 'campaignName' => '',);

//         $value = $soapClient->__call("OneToOne", array($paramArray));
//         if (substr(get_object_vars($value)["OneToOneResult"], 0, 4) == "1903") {
//             Mail::raw('Onnorokom needs to be recharged', function ($message) {
//                 $message->to("ahmed@panacea.live");
//                 $message->subject("[Panacea] Onnorokom Recharge Alert!");
//             });
//             return false;
//         }
//         return true;
//     } catch (Exception $e) {
//         \Log::error("Traits/SendConfirmationCode.php file. Details: ".$e->getMessage());
//         return false;
//     }
// }
