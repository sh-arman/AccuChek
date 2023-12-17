<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    public function index()
    {
        // return "Under Maintenance";
        // $startDate = '2022-08-03';
        // $endDate = '2022-10-05';
        // $startDate =  date('d-m-Y', strtotime($start));
        // $endDate =  date('d-m-Y', strtotime($end));

        $startDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month"));
        $endDate = date("Y-m-d");

        $datas = DB::table('checks')
            ->select('id', 'phone_number', 'code', 'remarks', 'source', 'created_at')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($datas) {
                return Carbon::parse($datas->created_at)->format('d M y');
            });

        $total = count(DB::table('checks')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $totalSms = count(DB::table('checks')
            ->where('source', 'sms')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $totalWeb = count(DB::table('checks')
            ->where('source', 'web')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $firstTime = count(DB::table('checks')
            ->where('remarks', 'firsttime')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $verified = count(DB::table('checks')
            ->where('remarks', 'verified')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $months = [];
        $monthCount = [];
        foreach ($datas as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        return view('admin.analytics', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'total' => $total,
            'totalSms' => $totalSms,
            'totalWeb' => $totalWeb,
            'firstTime' => $firstTime,
            'verified' => $verified,
            'datas' => $datas,
            'months' => $months,
            'monthCount' => $monthCount,
        ]);
    }



    public function search(Request $request)
    {
        // return $request->all();
        // dates
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate = date('Y-m-d', strtotime($request->endDate));

        // return 'all';
        $datas = DB::table('checks')
            ->select('id', 'phone_number', 'code', 'remarks', 'source', 'created_at')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($datas) {
                return Carbon::parse($datas->created_at)->format('d M y');
        });

        $total = count(DB::table('checks')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $totalSms = count(DB::table('checks')
            ->where('source', 'sms')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $totalWeb = count(DB::table('checks')
            ->where('source', 'web')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $firstTime = count(DB::table('checks')
            ->where('remarks', 'firsttime')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $verified = count(DB::table('checks')
            ->where('remarks', 'verified')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $months = [];
        $monthCount = [];
        foreach ($datas as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        return view('admin.analytics', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'total' => $total,
            'totalSms' => $totalSms,
            'totalWeb' => $totalWeb,
            'firstTime' => $firstTime,
            'verified' => $verified,
            'datas' => $datas,
            'months' => $months,
            'monthCount' => $monthCount,
        ]);
    }



    public function csv(Request $request)
    {
        # code...
        // return $request->all();

        $sDate = date('Y-m-d', strtotime($request->sDate));
        $eDate = date('Y-m-d', strtotime($request->eDate));

        if($request->remarks == 'firsttime')
        {
            // return 'firsttime';
            $datas = DB::table('checks')
                ->select('id', 'phone_number', 'code', 'remarks', 'source', 'created_at')
                ->where('remarks', 'firsttime')
                ->whereBetween('created_at', [$sDate. " 00:00:00" , $eDate . " 23:59:59" ])
                ->orderBy('created_at', 'asc')
                ->get()
                ->groupBy(function ($datas) {
                    return Carbon::parse($datas->created_at)->format('d M y');
                });

            $total = count(DB::table('checks')
                ->where('remarks', 'firsttime')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $totalSms = count(DB::table('checks')
                ->where('remarks', 'firsttime')
                ->where('source', 'sms')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $totalWeb = count(DB::table('checks')
                ->where('remarks', 'firsttime')
                ->where('source', 'web')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $firstTime = count(DB::table('checks')
                ->where('remarks', 'firsttime')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $verified = NULL;

            // $verified = count(DB::table('checks')
            //     ->where('remarks', 'verified')
            //     ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
            //     ->get());
        }
        else if ($request->remarks == 'verified')
        {
            // return 'verified';
            $datas = DB::table('checks')
            ->select('id', 'phone_number', 'code', 'remarks', 'source', 'created_at')
            ->where('remarks', 'verified')
            ->whereBetween('created_at', [$sDate. " 00:00:00" , $eDate . " 23:59:59" ])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($datas) {
                return Carbon::parse($datas->created_at)->format('d M y');
            });

            $total = count(DB::table('checks')
                ->where('remarks', 'verified')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $totalSms = count(DB::table('checks')
                ->where('remarks', 'verified')
                ->where('source', 'sms')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $totalWeb = count(DB::table('checks')
                ->where('remarks', 'verified')
                ->where('source', 'web')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $firstTime = NULL;

            $verified = count(DB::table('checks')
                ->where('remarks', 'verified')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());
        }
        else {
            // return 'firsttime';
            $datas = DB::table('checks')
                ->select('id', 'phone_number', 'code', 'remarks', 'source', 'created_at')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->orderBy('created_at', 'asc')
                ->get()
                ->groupBy(function ($datas) {
                    return Carbon::parse($datas->created_at)->format('d M y');
                });

            $total = count(DB::table('checks')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $totalSms = count(DB::table('checks')
                ->where('source', 'sms')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $totalWeb = count(DB::table('checks')
                ->where('source', 'web')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $firstTime = count(DB::table('checks')
                ->where('remarks', 'firsttime')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());

            $verified = count(DB::table('checks')
                ->where('remarks', 'verified')
                ->whereBetween('created_at', [$sDate . " 00:00:00", $eDate . " 23:59:59"])
                ->get());
        }

        $months = [];
        $monthCount = [];
        foreach ($datas as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }


        $fileToExport = date("d-m-y") . ' - LiveCheck Report';
        $html = View('admin.csv')
        ->with([
            'sDate' => $sDate,
            'eDate' => $eDate,
            'total' => $total,
            'totalSms' => $totalSms,
            'totalWeb' => $totalWeb,
            'firstTime' => $firstTime,
            'verified' => $verified,
            'datas' => $datas,
            'months' => $months,
            'monthCount' => $monthCount,
        ]);
        header("Content-Disposition: attachment; filename=".$fileToExport.'.xls');
        header("Content-type: application/vnd.ms-excel");
        return $html;
    }




    public function lastyear()
    {
        // $startDate = '2022-08-03';
        // $endDate = '2022-10-05';
        // $startDate =  date('d-m-Y', strtotime($start));
        // $endDate =  date('d-m-Y', strtotime($end));

        $startDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 year"));
        $endDate = date("Y-m-d");

        $datas = DB::table('checks')
            ->select('id', 'phone_number', 'code', 'remarks', 'source', 'created_at')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($datas) {
                return Carbon::parse($datas->created_at)->format('d M y');
            });

        $total = count(DB::table('checks')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $totalSms = count(DB::table('checks')
            ->where('source', 'sms')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $totalWeb = count(DB::table('checks')
            ->where('source', 'web')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $firstTime = count(DB::table('checks')
            ->where('remarks', 'firsttime')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $verified = count(DB::table('checks')
            ->where('remarks', 'verified')
            ->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
            ->get());

        $months = [];
        $monthCount = [];
        foreach ($datas as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        return view('admin.analytics', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'total' => $total,
            'totalSms' => $totalSms,
            'totalWeb' => $totalWeb,
            'firstTime' => $firstTime,
            'verified' => $verified,
            'datas' => $datas,
            'months' => $months,
            'monthCount' => $monthCount,
        ]);
    }
}















//
// <?php

// namespace App\Http\Controllers;

// use DateTime;
// use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\DB;

// use App\Charts\AnalyticsChart;

   // if ((empty($request->startDate) || empty($request->endDate))) {
        //     $startDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month"));
        //     $endDate = date("Y-m-d");
        // }


// class AnalyticController extends Controller
// {

//     // $locations = DB::table('checks')
//     //         ->select('location', DB::raw('count(*) as total'))
//     //         ->groupBy('location')
//     //         ->get();

//     function index() {

//         $allData = DB::table('checks')->get();


//         $q = ' ';
//         $month = ' ';
//         $fromDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
//         $toDate = date("Y-m-d");
//         $month_array = array();
//         $check_dates = DB::table('checks')
//             ->whereBetween('created_at', [$fromDate, $toDate])
//             ->orderBy('created_at', 'ASC')
//             ->pluck('created_at');
//         $check_dates = json_decode($check_dates);

//         if ($check_dates) {
//             foreach ($check_dates as $date) {
//                 $month_number = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m');
//                 $month_name = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('M');
//                 $month_array[$month_number] = $month_name;
//             }
//         }

//         $totalCheck = 0;
//         $web = 0;
//         $sms = 0;
//         $max = 0;


//         foreach ($month_array as $m => $mn) {
//             $q .= $this->monthlyCheckCount($m) . ',' ;
//             $totalCheck += $this->monthlyCheckCount($m);
//             $web += $this->monthlyWebCheckCount($m);
//             $sms += $this->monthlySmsCheckCount($m);
//             $month .= $mn.',';
//         }
//         $max = count($month_array);
//         $max = round(($max + 10 / 2) / 10) * 10;
//         // $month;
//         $month = rtrim($month, ',');
//         $q = rtrim($q, ',');

//         return view('admin.analytic')->with([
//             'allData'=>$allData,
//             'q'=>$q,
//             'totalcheck'=>$totalCheck,
//             'month' => $month,
//             'fromDate' => $fromDate,
//             'toDate' => $toDate,
//             'web' => $web,
//             'sms' => $sms,
//             'max' => $max
//         ]);
//     }


//     function custom_date_search_analytics(Request $request) {

//         $q = ' ';
//         $month = ' ';

//         if( $request->start_date ){
//             $fromDate = date("Y-m-d", strtotime($request->start_date) );
//         }else{
//         $fromDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
//         }

//         if( $request->end_date) {
//             $toDate = date("Y-m-d", strtotime($request->end_date) );
//         }else {
//             $toDate = date("Y-m-d");
//         }

//         $month_array = array();
//         $check_dates = DB::table('checks')
//             ->whereBetween('created_at', [$fromDate, $toDate])
//             ->orderBy('created_at', 'ASC')
//             ->pluck('created_at');
//         $check_dates = json_decode($check_dates);

//         if ($check_dates) {
//             foreach ($check_dates as $date) {
//                 $month_number = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m');
//                 $month_name = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('M');
//                 $month_array[$month_number] = $month_name;
//             }
//         }

//         $totalCheck = 0;
//         $web = 0;
//         $sms = 0;

//         foreach ($month_array as $m => $mn) {
//             $q .= $this->monthlyCheckCount($m) . ',' ;
//             $totalCheck += $this->monthlyCheckCount($m);
//             $web += $this->monthlyWebCheckCount($m);
//             $sms += $this->monthlySmsCheckCount($m);
//             $month .= $mn.',';
//         }

//         // return $max = max($q);
//         // $max = round(($max + 10 / 2) / 10) * 10;

//         // $month;
//         $month = rtrim($month, ',');
//         $q = rtrim($q, ',');
//         return view('admin.analytic')->with([
//             'q'=>$q,
//             'totalcheck'=>$totalCheck,
//             'month' => $month,
//             'fromDate' => $fromDate,
//             'toDate' => $toDate,
//             'web' => $web,
//             'sms' => $sms,
//         ]);
//     }


//     function last_month_six_search_analytics(Request $request) {
//         // return 'last_month_search_analytics';
//         $q = ' ';
//         $month = ' ';
//         $fromDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-6 month" ) );
//         $toDate = date("Y-m-d");
//         $month_array = array();
//         $check_dates = DB::table('checks')
//             ->whereBetween('created_at', [$fromDate, $toDate])
//             ->orderBy('created_at', 'ASC')
//             ->pluck('created_at');
//         $check_dates = json_decode($check_dates);

//         if ($check_dates) {
//             foreach ($check_dates as $date) {
//                 $month_number = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m');
//                 $month_name = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('M');
//                 $month_array[$month_number] = $month_name;
//             }
//         }

//         $totalCheck = 0;
//         $web = 0;
//         $sms = 0;

//         foreach ($month_array as $m => $mn) {
//             $q .= $this->monthlyCheckCount($m) . ',' ;
//             $totalCheck += $this->monthlyCheckCount($m);
//             $web += $this->monthlyWebCheckCount($m);
//             $sms += $this->monthlySmsCheckCount($m);
//             $month .= $mn.',';
//         }

//         // return $max = max($q);
//         // $max = round(($max + 10 / 2) / 10) * 10;

//         // $month;
//         $month = rtrim($month, ',');
//         $q = rtrim($q, ',');
//         return view('admin.analytic')->with([
//             'q'=>$q,
//             'totalcheck'=>$totalCheck,
//             'month' => $month,
//             'fromDate' => $fromDate,
//             'toDate' => $toDate,
//             'web' => $web,
//             'sms' => $sms,
//         ]);
//     }


//     function last_year_search_analytics(Request $request) {
//         // return 'last_year_search_analytics';
//         $q = ' ';
//         $month = ' ';
//         $fromDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-12 month" ) );
//         $toDate = date("Y-m-d");
//         $month_array = array();
//         $check_dates = DB::table('checks')
//             ->whereBetween('created_at', [$fromDate, $toDate])
//             ->orderBy('created_at', 'ASC')
//             ->pluck('created_at');
//         $check_dates = json_decode($check_dates);

//         if ($check_dates) {
//             foreach ($check_dates as $date) {
//                 $month_number = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m');
//                 $month_name = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('M');
//                 $month_array[$month_number] = $month_name;
//             }
//         }

//         $totalCheck = 0;
//         $web = 0;
//         $sms = 0;

//         foreach ($month_array as $m => $mn) {
//             $q .= $this->monthlyCheckCount($m) . ',' ;
//             $totalCheck += $this->monthlyCheckCount($m);
//             $web += $this->monthlyWebCheckCount($m);
//             $sms += $this->monthlySmsCheckCount($m);
//             $month .= $mn.',';
//         }

//         // return $max = max($q);
//         // $max = round(($max + 10 / 2) / 10) * 10;

//         // $month;
//         $month = rtrim($month, ',');
//         $q = rtrim($q, ',');
//         return view('admin.analytic')->with([
//             'q'=>$q,
//             'totalcheck'=>$totalCheck,
//             'month' => $month,
//             'fromDate' => $fromDate,
//             'toDate' => $toDate,
//             'web' => $web,
//             'sms' => $sms,
//         ]);
//     }


//     function monthlyCheckCount($month)
//     {
//         return count(DB::table('checks')->whereMonth('created_at', $month)->get());
//     }

//     function monthlyWebCheckCount($month)
//     {
//         return count(DB::table('checks')->where('source','web')->whereMonth('created_at', $month)->get());
//     }

//     function monthlySmsCheckCount($month)
//     {
//         return count(DB::table('checks')->where('source','sms')->whereMonth('created_at', $month)->get());
//     }



// }
