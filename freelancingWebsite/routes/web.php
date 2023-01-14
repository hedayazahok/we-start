<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\ClientProjectController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\freelancer\FreelancerController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'browseProject'])->name('home');
Route::post('/filter', [App\Http\Controllers\HomeController::class, 'filter'])->name('filter');

Route::get('/freelancers', [App\Http\Controllers\HomeController::class, 'hireFreelancer'])->name('freelancers');

//Auth::routes();
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('login/freelancer', [App\Http\Controllers\Auth\LoginController::class, 'showFreelancerLoginForm'])->name('login.freelancer');
Route::post('login/freelancer', [App\Http\Controllers\Auth\LoginController::class, 'loginFreelancer']);

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
// Password Reset Routes...

Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm']);
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset']);


Route::get('/projects', [App\Http\Controllers\HomeController::class, 'browseProject'])->name('browseProject');
Route::get('/project/{slug}', [App\Http\Controllers\HomeController::class, 'showProject'])->name('showProject');

Route::get('/projectByTag/{tag}', [App\Http\Controllers\HomeController::class, 'showProjectByTag'])->name('showProjectByTag');
Route::get('/portfolios/{id}',[PortfolioController::class,'index'])->name('freelancer.portfolios.index');

Route::get('/portfolio-details/{id}',[PortfolioController::class,'show'])->name('freelancer.portfolios.show');

Route::get('freelancer/profile/{id}',[FreelancerController::class,'profile'])->name('freelancer.profile');

Route::middleware('auth:freelancer')->prefix('freelancer')->name('freelancer')->group(function () {
    Route::get('/dashboard',[FreelancerController::class,'dashboard'])->name('.dashboard');
    Route::get('/dashboard',[FreelancerController::class,'dashboard'])->name('.dashboard');
    Route::get('/profileSetting',[FreelancerController::class,'setting_form'])->name('.profile.settingForm');

    Route::put('/profileSetting/{id}',[FreelancerController::class,'setting'])->name('.profile.setting');
    Route::get('/logout',[FreelancerController::class,'logout'])->name('.logout');

    Route::post('/proposal',[ProposalController::class,'store'])->name('.proposal.store');
    Route::get('/proposals',[ProposalController::class,'index'])->name('.proposal.index');

    Route::post('/proposal/fileUpload', [ProposalController::class, 'fileUpload'])->name('.fileUpload');
    Route::post('/proposal/fileUploadRemoved',[ProposalController::class, 'fileDestroy'])->name('.fileDestroy');
    Route::get('proposal-edit/{id}',[ProposalController::class,'edit']);
Route::post('proposal-edit',[ProposalController::class,'update'])->name('.proposal.update');


Route::post('/proposal/complete/{id}',[ProposalController::class,'complete'])->name('.proposal.complete');

//Portfolio
Route::get('/portfolios/create/{id}',[PortfolioController::class,'create'])->name('.portfolios.create');

Route::post('/portfolios/create',[PortfolioController::class,'store'])->name('.portfolios.store');
Route::get('/portfolios/edit/{id}',[PortfolioController::class,'edit'])->name('.portfolios.edit');
Route::put('/portfolios/update/{id}',[PortfolioController::class,'update'])->name('.portfolios.update');
Route::post('/portfolios/fileUpload', [PortfolioController::class, 'fileUpload'])->name('.portfolios.fileUpload');
Route::post('/portfolios/fileUploadRemoved/{id?}',[PortfolioController::class, 'fileDestroy'])->name('.portfolios.fileDestroy');

Route::delete('/portfolios/{id}',[PortfolioController::class,'destroy'])->name('.portfolios.destroy');




});
Route::get('/dues/{price}',[ProposalController::class, 'discountByPercent'])->name('dues');



//client
Route::middleware(['auth'])->prefix('client')->name('client')->group(function () {

    Route::get('/notifications', [ClientController::class,'notifications']);

    Route::get('/profile',[ClientController::class,'profile'])->name('.profile');
    Route::get('/profileSetting',[ClientController::class,'setting_form'])->name('.profile.settingForm');
    Route::put('/profileSetting/{id}',[ClientController::class,'setting'])->name('.profile.setting');
    Route::get('/profile/logout',[ClientController::class,'logout'])->name('.logout');
    Route::get('/myProject',[ClientProjectController::class,'index'])->name('.project.index');
    Route::get('/project/create',[ClientProjectController::class,'create'])->name('.project.create');
    Route::post('/project/create',[ClientProjectController::class,'store'])->name('.project.store');
    Route::get('/proposalCancled/{id}',[ClientProjectController::class,'proposalCancled'])->name('.project.proposalCancled');
    Route::get('/proposalAccept/{id}',[ClientProjectController::class,'proposalAccept'])->name('.project.proposalAccept');

    Route::get('/project/{id}-{name}',[ClientProjectController::class,'show'])->name('.project.show');

    Route::post('fileUpload', [ClientProjectController::class, 'fileUpload'])->name('.fileUpload');
    Route::post('fileUploadRemoved',[ClientProjectController::class, 'fileDestroy'])->name('.fileDestroy');
    //delivery
    Route::get('/proposal/deliver/{id}',[ProposalController::class,'delivery'])->name('.proposal.delivery');
    Route::get('/complete_contract/{id}',[ContractController::class,'complete'])->name('.contract.complete');
    Route::get('/reject_receipt/{id}',[ContractController::class,'reject_receipt'])->name('.contract.reject');

});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin')->group(function () {


    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('.dashboard');
    Route::get('/users',[AdminController::class,'users'])->name('.user');
    Route::get('/freelancers',[AdminController::class,'freelancers'])->name('.freelancer');
    Route::post('/changeStatus',[AdminController::class,'changeStatus'])->name('.changeStatus');
    Route::get('/projects',[AdminController::class,'projects'])->name('.projectUnderReview');
    Route::get('/category',[CategoryController::class,'index'])->name('.category.index');
    Route::post('/category',[CategoryController::class,'store'])->name('.category.store');
    Route::put('/category/update',[CategoryController::class,'update'])->name('.category.update');
    Route::delete('/category/delete/{id}',[CategoryController::class,'destroy'])->name('.category.delete');
    Route::get('/open_project/{id}',[AdminController::class,'openProject'])->name('.openProject');
    Route::get('/settings',[AdminController::class,'setting_form'])->name('.setting');
    Route::post('/settings',[AdminController::class,'setting']);


});

Route::get('/stripe-payment', [StripeController::class, 'handleGet']);
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');
Route::get('/contractPage/{id}', [ContractController::class, 'contract_page'])->name('contractPage');
Route::post('/stripe-payout', [StripeController::class, 'payout'])->name('payout');


Route::post('/message', [ContractController::class, 'message'])->name('message');

Route::get('/file-download/{id}', [ContractController::class, 'download_files'])->name('file.download');

//Route::get('/proposal/deliver/{id}',[ProposalController::class,'delivery'])->name('.proposal.delivery');

//delivery
Route::get('/proposal/deliver/{id}',[ProposalController::class,'delivery'])->name('proposal.delivery');
