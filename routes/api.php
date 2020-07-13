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

// Route::post('register', 'API\RegisterController@register');

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('leaves', 'LeaveController@granteLeaves');
Route::post('usersleaves', 'LeaveController@userLeaves');
Route::post('leaveapplied', 'LeaveController@leaveApplied');
Route::post('leavestatus', 'LeaveController@leaveStatus');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

