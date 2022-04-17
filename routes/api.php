<?php

use Illuminate\Http\Request;
use App\Imports\TransactionImport;
use Maatwebsite\Excel\Facades\Excel;
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

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::get('profile', 'API\V1\ProfileController@profile');
Route::put('profile', 'API\V1\ProfileController@updateProfile');
Route::post('change-password', 'API\V1\ProfileController@changePassword');

Route::get('ticket/code','API\V1\TicketController@getCode');
Route::get('transaksi/print','API\V1\TransactionController@exportExcel');
Route::get('ticket/{ticket}/individu-check','API\V1\TransactionController@checkIndividualTicket');
Route::get('ticket/{ticket}/group-check','API\V1\TransactionController@checkGroupTicket');
Route::get('ticket/{id}/printQR','API\V1\TicketController@printQR');
Route::get('ticket/group','API\V1\TicketController@detailGroup');
Route::get('ticket/group-last','API\V1\TicketController@detailGroupLast');

Route::apiResources([
    'user' => 'API\V1\UserController',
    'ticket' => 'API\V1\TicketController',
    'transaction' => 'API\V1\TransactionController',
    'product' => 'API\V1\ProductController',
    'category' => 'API\V1\CategoryController',
    'tag' => 'API\V1\TagController',
]);
