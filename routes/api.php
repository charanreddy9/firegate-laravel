<?php

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\User;
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


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');


Route::group(['middleware' => 'cors','auth:api'], function(){
	Route::post('details', 'API\UserController@details');
	Route::post('insertadhoc', 'API\AdhocController@store');
	Route::get('showadhoc', 'API\AdhocController@show');
	Route::get('edit/{id}', 'API\AdhocController@edit');
	Route::get('search/{mobile}', 'API\AdhocController@search');
	Route::post('message', 'API\MessageController@message');
	Route::post('verifyotp', 'API\MessageController@verifyotp');
	Route::post('download-pdf', 'API\AdhocController@downloadPDF');
});