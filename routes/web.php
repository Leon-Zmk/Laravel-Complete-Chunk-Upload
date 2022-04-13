<?php

use App\Http\Controllers\UploderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("upload/create",function(){
    return view("Upload.create");
});

Route::post("upload/store",[UploderController::class,"store"])->name("upload.store");
Route::post("upload/delete",[UploderController::class,"delete"])->name("upload.delete");