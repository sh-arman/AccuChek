<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Order;
use App\Models\Track;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index( )
    {
        $codes = DB::table('codes')->select('id')->where('status', 0)->count();
        $templates = Template::orderBy('id', 'desc')->get();
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order')->with([
            'codes' => $codes,
            'templates' => $templates,
            'orders' => $orders,
        ]);
    }



    public function store(Request $req)
    {

        // dd($req->all());

        ini_set('memory_limit', '4090M');
        Track::create([
            'user_id' => Auth::user()->id,
            'action' => 3 // code generate
        ]);

        if ($req->quantity <= 400000) {

            $filename = $req->datapack_name.'.csv';

            $order = Order::create([
                'template_id' => $req->template_id,
                'manufacture_date' => $req->manufacture_date,
                'expiry_date' => $req->expiry_date,
                'quantity' => $req->quantity,
                'batch_number' => $req->batch_number,
                'file' => $filename,
            ]);

            $collection = DB::table('codes')
                            ->select('code')
                            ->where('status', 0)
                            ->where(DB::raw('CHAR_LENGTH(code)'), '=', 7)
                            ->where('code', 'not like', '%0%')
                            ->orderBy('id', 'desc')
                            ->take($req->quantity);

            $handle = fopen(public_path('Codes/' . $filename), 'w+');
            if ($req->quantity > 500) $chunk = 500;
            else $chunk = $req->quantity;

            foreach ($collection->get()->chunk($chunk) as $codes) {
                foreach ($codes as $code) {
                    fputcsv($handle, ["ACK " . $code->code ]);
                }
            }

            fclose($handle);
            $collection->update(['status' => $order->id]);
            Order::where('id', $order->id)->update(['status' => 'finished']);

            return back()->with('success', 'Code Generation Successfull.');

        } else {
            return back()->with('error', 'Code Generation Failed.');
        }
    }


}






// public function store(Request $req)
// {
//     // dd($req->all());

//     // $order_id = Order::select('id')->orderBy('id', 'desc')->first()->id;
//     // $order_id = $order_id+1;
//     $filename = $req->datapack_name . '_' . $req->file . '.csv';
//     // $req->manufacture_date = $req->manufacture_date . "-28";
//     // $req->expiry_date = $req->expiry_date . "-28";

//     $order = Order::create([
//         'template_id' => $req->template_id,
//         'manufacture_date' => $req->manufacture_date,
//         'expiry_date' => $req->expiry_date,
//         'quantity' => $req->quantity,
//         'batch_number' => $req->batch_number,
//         'file' => $filename,
//     ]);


//     Track::create([
//         'user_id' => Auth::user()->id,
//         'action' => 3 // code generate
//     ]);

//     $collection = Code::select('code')
//         ->where('status', 0)
//         ->where(DB::raw('CHAR_LENGTH(code)'), '=', 7)
//         ->where('code','not like','%0%')
//         ->orderBy('id','desc')
//         ->take($req->quantity);

//     $handle = fopen(public_path('Codes/' . $filename), 'w+');
//     if ($req->quantity > 500) $chunk = 500;
//     else $chunk = $req->quantity;

//     foreach ($collection->get()->chunk($chunk) as $codes) {
//         foreach ($codes as $code) {
//             fputcsv($handle, [
//                 "KUM " . $code->code,
//             ]);
//         }
//     }

//     fclose($handle);
//     $collection->update(['status' => $order->id]);
//     Order::where('id', $order->id)->update(['status' => 'finished']);

//     return back()->with('success','Code Generation Successfull.');
// }








// if ($request->prefix == "qr") {
//     foreach ($collection->get()->chunk($chunk) as $codes) {
//         //echo "1";
//         foreach ($codes as $code) {
//             fputcsv($handle, [
//                 'https://panacea.live/v/' . $code->code,
//                 // 'qrv.io/v/' . $code->code,
//             ]);
//         }
//     }
// }
