<?php

use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\ChaletController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\WelcomeController;
use App\Models\Chalet;
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


Route::get('/',[WelcomeController::class,'index'])->name('welcome');
Route::get('/chalet/{id}',[WelcomeController::class,'show'])->name('chalet.show');
Route::post('/booking/{id}',[WelcomeController::class,'booking'])->name('chalet.booking');
Route::post('/filter',[WelcomeController::class,'filter'])->name('filter');




Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dash');


Route::prefix('dashboard')->name('admin')->group(function(){

    Route::get('/chalets',[ChaletController::class,'index'])->name('.chalet.index');
    Route::get('/chalet/{id?}',[ChaletController::class,'create'])->name('.chalet.create');
    Route::post('/chalet/create',[ChaletController::class,'store'])->name('.chalet.store');
    Route::put('/chalet/{id}',[ChaletController::class,'update'])->name('.chalet.update');
    Route::delete('/chalet/{id}',[ChaletController::class,'destroy'])->name('.chalet.destroy');
    Route::get('/bookings',[BookingController::class,'index'])->name('.booking.index');
    Route::get('/booking/{id?}',[BookingController::class,'show'])->name('.booking.show');
    Route::delete('/booking/{id}',[BookingController::class,'destroy'])->name('.booking.destroy');



});



