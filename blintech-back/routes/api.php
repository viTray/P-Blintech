<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function(){
});
    Route::apiResource('customers', 'CustomerController');
    Route::apiResource('receptions', 'ReceptionController');
    Route::apiResource('receptionImages', 'ReceptionImageController');
    Route::apiResource('comments', 'CommentController');
    Route::apiResource('commentImages', 'CommentImageController');
    Route::apiResource('brands', 'BrandController');
    Route::apiResource('types', 'TypeController');
    Route::apiResource('titles', 'TitleController');
    Route::apiResource('generals', 'GeneralController');
    Route::apiResource('accessorys', 'AccessoryController');
    Route::apiResource('exteriors', 'ExteriorController');
    Route::apiResource('delivereds', 'DeliveredController');
    Route::post('mail', 'MailB');
    Route::get('imprimir', 'Gpdf@generate');















