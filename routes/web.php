<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(HomeController::class)->group(function(){
    Route::get('/home','index')->name('home');
    Route::get('/add-new','addNew')->name('add-new');
    Route::post('/add-new','storeNew')->name('store-new');
    Route::get('/show/{id}','showNew')->name('show-new');
    Route::get('/edit-new/{id}','editNew')->name('edit-new');
    Route::post('/update-new/{id}','updateNew')->name('update-new');
    Route::get('/delete-new/{id}','deleteNew')->name('delete-new');
    Route::post('/newComment/{id}','newComment')->name('newComment');
    Route::get('/allUsers',"allUsers")->name('allUsers');
    Route::get('/profile/{id}',"profile")->name('profile');
});


