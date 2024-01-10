<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
use App\Models\Check;
use App\Models\Order;
use App\Models\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckController extends Controller
{
    use Traits\ConfirmationCode;



    public function locale($locale)
    {
        session()->put('locale', $locale);
        return redirect()->back();
    }

    // Code Verification
    public function codeVerify(Request $req)
    {
        $code = str_replace(' ', '', $req->code);
        if (strlen($code) <= 7 || strlen($code) >= 11) {
            $response = ['CodeNull' => 'CodeNull'];
        } else {
            if (strlen($code) >= 7) {
                if (strtoupper(substr($code, 0, 3)) == "ACK") {
                    $code = substr($code, 3);
                }
                $code = strtoupper($code);

                $exists = Code::where('code', $code)->first();
                if ($exists) {
                    session(['code' => $code]);
                    $response = ['success' => "success"];
                } else {
                    $response = ['CodeWrong' => 'CodeWrong'];
                }
            }
            else {
                $response = ['CodeWrong' => 'CodeWrong'];
            }
        }
        return response()->json($response);
    }


    // // Phone Verification
    public function phoneVerify(Request $req)
    {
        $phoneNo = User::IsValidPhoneNo($req->phone);
        if ($phoneNo) {
            if (!$user = User::where('phone_number', $phoneNo)->first()) {
                $user = User::Create(['phone_number' => $phoneNo]);
            }
            session([
                'userId'  => $user->id,
                'phoneNo' => $phoneNo,
            ]);
            $userId = $user->id;
            $response = [
                'success' => 'success',
                'PhoneSuccess' => $phoneNo,
            ];

            // if ($this->ConfirmationCode($userId)) {
            //     $response = [
            //         'success' => 'success',
            //         'PhoneSuccess' => $phoneNo,
            //     ];
            // }
            // else {
            //     $response = ['PhoneError' => 'PhoneError'];
            // }
        } else {
            $response = ['PhoneNull' => 'PhoneNull'];
        }
        return $response;
    }



    // liveCheck Verification
    public function liveCheck(Request $req)
    {
        // if (strlen($req->otp) == 4) {
            // $user = User::find(session('userId'));
            // $otp = strtoupper($req->otp);

            // if (Activation::complete($user, $otp)) {
                $phoneNo = session('phoneNo');
                $code = session('code');

               // location
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // $ch_res = curl_exec($ch);
                // $ch_res = json_decode($ch_res);

                try {
                    $checkHistory = new Check;
                    $checkHistory->code = $code;
                    $checkHistory->phone_number = $phoneNo;
                    $checkHistory->source = 'web';
                    $checkHistory->location = NULL;
                    // $checkHistory->location = $ch_res->city;

                    $exists = Code::where('code', $code)->first();
                    $verified = Check::where('code', $exists->code)->orderBy('created_at', 'asc')->first();

                    $verificationCount = Check::where('code', $code)->count();
                    $verificationCount += 1;

                    $order = Order::find($exists->status);
                    if ($order) {
                        $today = date("M D");
                        // if (strtotime($order->expiry_date) < strtotime($today)) {

                        //     $checkHistory->remarks = "expired";
                        //     $response = [
                        //         'status' => 'expired',
                        //         'expired_manufacture' => $order->template->manufacture,
                        //         'expired_product' => $order->template->product,
                        //         'expired_detail' => $order->template->detail,
                        //         'expired_manufacture_date' => $order->manufacture_date->format('M Y'),
                        //         'expired_expiry' => $order->expiry_date->format('M Y'),
                        //         'expired_batch' => $order->batch_number,
                        //     ];
                        //     $checkHistory->save();
                        //     return $response;
                        // }
                        // else if ($verified) {
                        if ($verified) {
                            $checkHistory->remarks = "verified";
                            $response = [
                                'status' => 'verified',
                                'verified_manufacture' => $order->template->manufacture,
                                'verified_product' => $order->template->product,
                                'verified_detail' => $order->template->detail,
                                'verified_manufacture_date' => $order->manufacture_date->format('M Y'),
                                'verified_expiry' => $order->expiry_date->format('M Y'),
                                'verified_batch' => $order->batch_number,

                                'verified_preNumber' => substr($verified->phone_number, 0, 5) . '***' . substr($verified->phone_number, 8),
                                'verified_preDate' => $verified->created_at->format('d/m/Y'),
                                'verified_totalCount' => $verificationCount,
                            ];
                            $checkHistory->save();
                            return $response;
                        } else {
                            $checkHistory->remarks = "firsttime";
                            $response = [
                                'status' => 'firsttime',
                                'manufacture' => $order->template->manufacture,
                                'product' => $order->template->product,
                                'detail' => $order->template->detail,
                                'manufacture_date' => $order->manufacture_date->format('M Y'),
                                'expiry' => $order->expiry_date->format('M Y'),
                                'batch' => $order->batch_number,
                            ];
                            $checkHistory->save();
                            return $response;
                        }
                    }
                } catch (\Illuminate\Database\QueryException $e) {
                    Log::info("HandleCode Error :" . $e->getMessage());
                }
            // } else {
            //     $response = ['LiveError' => 'LiveError'];
            // }
        // } else {
        //     $response = ['LiveNull' => 'LiveNull'];
        // }
        return true;
    }




    public function search_code(Request $request)
    {
        # code...
        $code = $request->code;
        if (Code::where('code', $code)->first()) {
            $response = [
                'success' => 'success',
            ];
        }else {
            $response = [
                'error' => 'error',
            ];
        }
        return $response;
    }
}






//  Code Send
// try {
//     $soapClient = new SoapClient("https://user.mobireach.com.bd/index.php?r=sms/service");
//     $value = $soapClient->SendTextMessage('panacealive', 'Panacearocks@2022', 'MAXPRO', '8801947423947', $code);
// } catch (\Illuminate\Database\QueryException $e) {
//     Log::info("Code Verify :" . $e->getMessage());
// }




// public function urlCode( $code ) {
//     $code = strtoupper( $code );
//     $code = preg_replace( '/[^a-zA-Z]/', '', $code );
//     $data['code'] = $code;
//     // print_r($data['code']);
//     return view( 'livecheckpro.index' )->with( $data );
// }




/// with otp function

// <?php

// namespace App\Http\Controllers;

// use App\Models\Code;
// use App\Models\User;
// use App\Models\Check;
// use App\Models\Order;
// use App\Models\Activation;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class CheckController extends Controller
// {
//     use Traits\ConfirmationCode;



//     public function locale($locale)
//     {
//         session()->put('locale', $locale);
//         return redirect()->back();
//     }

//     // Code Verification
//     public function codeVerify(Request $req)
//     {
//         if ($req->code == NULL) {
//             $response = ['CodeNull' => 'CodeNull'];
//         } else {
//             $code = str_replace(' ', '', $req->code);
//             if (strlen($code) >= 7) {
//                 if (strtoupper(substr($code, 0, 3)) == "SFS") {
//                     $code = substr($code, 3);
//                 }
//                 $code = strtoupper($code);

//                 $exists = Code::where('code', $code)->first();
//                 if ($exists) {
//                     session(['code' => $code]);
//                     $response = ['success' => "success"];
//                 } else {
//                     $response = ['CodeWrong' => 'CodeWrong'];
//                 }
//             }
//             else {
//                 $response = ['CodeWrong' => 'CodeWrong'];
//             }
//         }
//         return response()->json($response);
//     }


//     // // Phone Verification
//     public function phoneVerify(Request $req)
//     {
//         $phoneNo = User::IsValidPhoneNo($req->phone);
//         if ($phoneNo) {
//             if (!$user = User::where('phone_number', $phoneNo)->first()) {
//                 $user = User::Create(['phone_number' => $phoneNo]);
//             }
//             session([
//                 'userId'  => $user->id,
//                 'phoneNo' => $phoneNo,
//             ]);
//             $userId = $user->id;

//             if ($this->ConfirmationCode($userId)) {
//                 $response = [
//                     'success' => 'success',
//                     'PhoneSuccess' => $phoneNo,
//                 ];
//             }
//             else {
//                 $response = ['PhoneError' => 'PhoneError'];
//             }
//         } else {
//             $response = ['PhoneNull' => 'PhoneNull'];
//         }
//         return $response;
//     }



//     // liveCheck Verification
//     public function liveCheck(Request $req)
//     {
//         if (strlen($req->otp) == 4) {
//             $user = User::find(session('userId'));
//             $otp = strtoupper($req->otp);

//             if (Activation::complete($user, $otp)) {
//                 $phoneNo = session('phoneNo');
//                 $code = session('code');

//                 // location
//                 $ch = curl_init();
//                 curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
//                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                 $ch_res = curl_exec($ch);
//                 $ch_res = json_decode($ch_res);

//                 try {
//                     $checkHistory = new Check;
//                     $checkHistory->code = $code;
//                     $checkHistory->phone_number = $phoneNo;
//                     $checkHistory->source = 'web';
//                     $checkHistory->location = $ch_res->city;

//                     $exists = Code::where('code', $code)->first();
//                     $verified = Check::where('code', $exists->code)->orderBy('created_at', 'asc')->first();

//                     $verificationCount = Check::where('code', $code)->count();
//                     $verificationCount += 1;

//                     $order = Order::find($exists->status);
//                     if ($order) {
//                         $today = date("M D");
//                         if (strtotime($order->expiry_date) < strtotime($today)) {

//                             $checkHistory->remarks = "expired";
//                             $response = [
//                                 'status' => 'expired',
//                                 'expired_manufacture' => $order->template->manufacture,
//                                 'expired_product' => $order->template->product,
//                                 'expired_detail' => $order->template->detail,
//                                 'expired_manufacture_date' => $order->manufacture_date->format('M Y'),
//                                 'expired_expiry' => $order->expiry_date->format('M Y'),
//                                 'expired_batch' => $order->batch_number,
//                             ];
//                             $checkHistory->save();
//                             return $response;
//                         } else if ($verified) {
//                             $checkHistory->remarks = "verified";
//                             $response = [
//                                 'status' => 'verified',
//                                 'verified_manufacture' => $order->template->manufacture,
//                                 'verified_product' => $order->template->product,
//                                 'verified_detail' => $order->template->detail,
//                                 'verified_manufacture_date' => $order->manufacture_date->format('M Y'),
//                                 'verified_expiry' => $order->expiry_date->format('M Y'),
//                                 'verified_batch' => $order->batch_number,

//                                 'verified_preNumber' => substr($verified->phone_number, 0, 5) . '***' . substr($verified->phone_number, 8),
//                                 'verified_preDate' => $verified->created_at->format('d/m/Y'),
//                                 'verified_totalCount' => $verificationCount,
//                             ];
//                             $checkHistory->save();
//                             return $response;
//                         } else {
//                             $checkHistory->remarks = "firsttime";
//                             $response = [
//                                 'status' => 'firsttime',
//                                 'manufacture' => $order->template->manufacture,
//                                 'product' => $order->template->product,
//                                 'detail' => $order->template->detail,
//                                 'manufacture_date' => $order->manufacture_date->format('M Y'),
//                                 'expiry' => $order->expiry_date->format('M Y'),
//                                 'batch' => $order->batch_number,
//                             ];
//                             $checkHistory->save();
//                             return $response;
//                         }
//                     }
//                 } catch (\Illuminate\Database\QueryException $e) {
//                     Log::info("HandleCode Error :" . $e->getMessage());
//                 }
//             } else {
//                 $response = ['LiveError' => 'LiveError'];
//             }
//         } else {
//             $response = ['LiveNull' => 'LiveNull'];
//         }
//         return $response;
//     }
// }



//  Code Send
// try {
//     $soapClient = new SoapClient("https://user.mobireach.com.bd/index.php?r=sms/service");
//     $value = $soapClient->SendTextMessage('panacealive', 'Panacearocks@2022', 'MAXPRO', '8801947423947', $code);
// } catch (\Illuminate\Database\QueryException $e) {
//     Log::info("Code Verify :" . $e->getMessage());
// }




// public function urlCode( $code ) {
//     $code = strtoupper( $code );
//     $code = preg_replace( '/[^a-zA-Z]/', '', $code );
//     $data['code'] = $code;
//     // print_r($data['code']);
//     return view( 'livecheckpro.index' )->with( $data );
// }
