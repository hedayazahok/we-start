<?php

use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\admin\ItemController;
use App\Http\Controllers\PDFController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('bills',BillController::class);

    Route::get('getBill/{id?}', [BillController::class, 'getBill']);
 //   Route::post('bills/', [BillController::class, 'store'])->name('bill');
    Route::get('bills/pdf/{bill}', [BillController::class, 'generatePDF'])->name('pdf.generate');



    Route::resource('items',ItemController::class);

});


Route::get('/', function () {
    return view('welcome');
});
