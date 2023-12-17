<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::post('/sslsms', [SmsController::class, 'sms']); //https://shaheenfood.live/sslsms?msisdn=8801675098204&sms=EB%20ABCDEFG
Route::get('/ssl-sms', [SmsController::class, 'sms']); //https://shaheenfood.live/api/sms-verification?msisdn=8801675098204&sms=EB%20ABCDEFG
