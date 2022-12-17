<?php

use App\Http\Controllers\QrCodeController;
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
Route::post('addImage', [QrCodeController::class, 'add_image'])->name('add_image');
Route::post('/event_create', [QrCodeController::class, 'event_create'])->name('event.create');

Route::get('conference/{id}', [QrCodeController::class, 'conference_register_form']);
Route::post('conference/{id}', [QrCodeController::class, 'conference_register'])->name('conference.register');

Route::get('generate_image/{id}', [QrCodeController::class, 'generate_image'])->name('generate_image');
