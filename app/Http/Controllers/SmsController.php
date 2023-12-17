<?php

namespace App\Http\Controllers;

use SoapClient;
use App\Models\Code;
use App\Models\User;
use App\Models\Check;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    public function sms(Request $request)
    {
        // return $request->all();
        // return 'এই পণ্যটি আসল এবং অরিজিনাল পণ্যটি শাহীন ফুড সাপ্লাইয়ার্স কর্তৃক আমদানিকৃত পন্যটি ক্রয় করার জন্য আন্তরিক ধন্যবাদ।';

            $code = $request->sms;
            // $code = strtoupper($request->sms);

            if (strlen($code) >= 7)
            {
                     // return $request->msisdn;
                    substr($code, 0, 3) == "SFS";
                    $code = strtoupper(substr($code, 3));
                    $code = str_replace( ' ', '' , $code );

                    $phoneNo = $request->msisdn;
                    $phoneNo = str_replace('+', '', $phoneNo);
                    $phoneNo = str_replace('88', '', $phoneNo);
                    // return $phoneNo;

                    // return $code .' একটি সঠিক কোড.';
                    $checkHistory = new Check;
                    $checkHistory->code = $code;
                    $checkHistory->phone_number = $phoneNo;
                    $checkHistory->source = 'sms';
                    $checkHistory->location = 'BD';

                    $exists = Code::where('code', $code)->first();
                    if($exists) {

                        $verified = Check::where('code', $exists->code)->orderBy('created_at', 'asc')->first();

                        $verificationCount = Check::where('code', $code)->count();
                        $verificationCount += 1;

                        $order = Order::findOrFail($exists->status);
                        if ($order)
                        {
                            // return $today . 'কোড';
                            if ($verified)
                            {
                                $checkHistory->remarks = "verified";
                                $preCheckPhoneNumber = substr($verified->phone_number, 0, 5) . '***' . substr($verified->phone_number, 8);
                                $preCheckDate = $verified->created_at->format('m/y');
                                $checkHistory->save();
                                // return 'পণ্যটি পূর্বে যাচাই করা হয়েছে ০১৭১১৬৬১১৮৪ নম্বর থেকে। নম্বরটি পরিচিত না হলে ক্র‍য় না করার জন্য অনুরোধ করা হলো।অভিযোগঃ 1 2';
                                // return 'এই কোডটি পূর্বেই যাচাইকৃত ' .$preCheckPhoneNumber. ' থেকে যদি যাচাইকারীর ফোন নম্বর পরিচিত কারোও না হয় তবে পণ্যটি নকল ফোন 01711661184';
                                return 'এই কোডটি পূর্বেই ' .$preCheckPhoneNumber. ' নম্বর থেকে যাচাইকৃত যাচাইকারীর ফোন নম্বর নিজের/পরিচিত কারোও না হলে পণ্যটি নকল ফোন 01711661184';
                                // return 'এই পণ্যটি পূর্বে যাচাই করা হয়েছে '.$preCheckDate.' -তে '.$preCheckPhoneNumber.' নম্বর থেকে। অভিযোগঃ ০১৭১১৬৬১১৮৪, ০১৯১২২২০৭০৪';
                                // return 'পণ্যটি পূর্বে যাচাই করা হয়েছিল '.$preCheckDate.' -তে '.$preCheckPhoneNumber.' নম্বর থেকে। আপনার পরিচিত না হলে ক্র‍য় না করার জন্য অনুরোধ করা হলো।';
                            } else
                            {
                                $checkHistory->remarks = "firsttime";
                                $checkHistory->save();
                                return 'পণ্যটি আসল/অরিজিনাল এবং শাহীন ফুড সাপ্লাইয়ার্স কর্তৃক আমদানিকৃত পন্যটি ক্রয় করার জন্য আন্তরিক ধন্যবাদ যোগাযোগঃ ০১৭১১৬৬১১৮৪';
                            }
                        }
                    }else {
                        // return 'কোডটি সঠিক নয় পূনরায় যাচাই করুন পূনরায় এই ম্যাসেজটি ফেরত আসলে ক্রয়ের পূর্বে পণ্যটি আসল/নকল তা নিশ্চিত হউন ফোন 01711661184';
                        return 'কোডটি ভুল আবার যাচাই করুন পূনরায় এই ম্যাসেজটি ফেরত আসলে ক্রয়ের পূর্বে ফোন করে পণ্যটি আসল/নকল নিশ্চিত হউন ফোন 01711661184';
                        // return 'কোডটি সঠিক নয় আবার যাচাই করুন পূনরায় এই ম্যাসেজটি ফেরত আসলে ক্রয়ের পূর্বে ফোন করে পণ্যটি আসল/নকল নিশ্চিত হউন ফোন 01711661184';
                        // return 'কোডটি সঠিক নয়।পুনরায় যাচাই করুন।পুনরায় মেসেজটি আসলে কোম্পানির নিকট ফোন করে যাচাই করে নিন। যোগাযোগঃ ০১৭১১৬৬১১৮৪';
                        // return 'এই পন্যটি নকল এবং ক্র‍য় না করার জন্য অনুরোধ করা হলো। অভিযোগঃ ০১৭১১৬৬১১৮৪, ০১৯১২২২০৭০৪';
                    }
            }
            else {
                return 'একটি সঠিক কোড নয়। SFS সহ ৭ ডিজিটের সঠিক কোড দিয়ে আবার চেষ্টা করুন.';
            }
    }

}
