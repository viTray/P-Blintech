<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

use App\Reception;
use SebastianBergmann\Environment\Console;

Route::get('/', function () {
    return view('PdfReception');

});
Route::get('/imprimir', 'Gpdf@generate');
