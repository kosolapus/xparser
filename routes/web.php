<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\IsbnToParseJsonController;


Route::get('/', function () {
    return view('amital');
})->name("home");



Route::get('/amital', function () {
    return redirect()->route('home');
});

//test
Route::any('/testnoty', "XParser@parse")->name("noty");

Route::any('/parse', "XParser@showData")->name("parser");

Route::get('/task/{task_id}/download', "XParser@download")->name("download");
