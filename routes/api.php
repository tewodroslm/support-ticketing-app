<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# Ar1 and Ar2 are roles with some admin previlages => moderator in short

Route::post('login', 'API\AuthController@login');
Route::post('/send-message', 'MessageController@store');
Route::middleware('auth:api')->group(function (){
    Route::middleware(['scope:admin,Ar2,Ar1'])->get('users', 'AddAdminUsers@getUsers');
    Route::middleware(['scope:admin,Ar2,Ar1'])->post('add-comment', 'API\CommentController@addComment');
    Route::middleware(['scope:admin'])->post('add-admin', 'AddAdminUsers@addAdmin');
    Route::middleware(['scope:admin'])->post('create-priority', 'API\PriorityController@create');
    Route::middleware(['scope:admin'])->post('create-status', 'API\StatusController@create');
    Route::middleware(['scope:admin,basic,Ar1,Ar2'])->post('create-ticket', 'API\TicketController@create');
    Route::middleware(['scope:basic'])->get('show-ticket', 'API\TicketController@show');
    Route::middleware(['scope:admin'])->post('update-ticket/{id}', 'API\TicketController@update');
    Route::middleware(['scope:admin'])->delete('delete-ticket/{id}', 'API\TicketController@destroy');
    Route::middleware(['scope:admin'])->get('all-ticket', 'API\TicketController@showAll');
    Route::middleware(['scope:admin'])->get('notifications', 'NotificationController@getNotifications');
    Route::middleware(['scope:Ar1,Ar2'])->get('mall-ticket', 'API\TicketController@showMTicket');
    Route::middleware('auth:api')->get('/get-message', 'MessageController@fetchMessage');
    Route::middleware(['scope:admin'])->delete("notification/{notificationId}", "NotificationController@deleteNotification");
});

