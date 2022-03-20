<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessionalController;


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
	if(Auth::id() > 0){
		 return redirect('/home');
	}
	else{
		return view('register');
	}
});

// Refresh CSRF Token
Route::get('refresh-csrf', function() {
    return csrf_token();
});
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);


Auth::routes();

Route::get('/subscription/create', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.create');
Route::get('/subscription/company/create', [App\Http\Controllers\SubscriptionController::class, 'companyCreate'])->name('subscription.company.create');
Route::get('/subscription/company/order-post', [App\Http\Controllers\SubscriptionController::class, 'companyPost'])->name('subscription.company.order.post');
#Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
#Route::post('order-post', ['as'=>'order-post','uses'=>'SubscriptionController@orderPost'])->name('order-post');
Route::post('order-post', [App\Http\Controllers\SubscriptionController::class, 'orderPost'])->name('order.post');
Route::post('order-company', [App\Http\Controllers\SubscriptionController::class, 'orderCompany'])->name('order.company');

Route::get('/payment', [App\Http\Controllers\SubscriptionController::class, 'showPayment'])->name('payment');
Route::post('/process', [App\Http\Controllers\SubscriptionController::class, 'paymentAction'])->name('payment_process');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('cart/make-payment', [App\Http\Controllers\HomeController::class, 'makeOrderPayment'])->name('cart.make-payment');
Route::get('/company/add', [App\Http\Controllers\HomeController::class, 'companyAdd'])->name('company.add');
Route::post('company/store', [App\Http\Controllers\HomeController::class, 'companySave'])->name('company.store');
Route::get('/company', [App\Http\Controllers\HomeController::class, 'listCompany'])->name('company.list');
Route::get('company/details/{id}', [App\Http\Controllers\HomeController::class, 'showCompany'])->name('company.details');
Route::get('profile/{id}/user', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.user');
Route::get('company/{id}/edit', [App\Http\Controllers\HomeController::class, 'editCompany'])->name('company.edit');
Route::put('/company/{id}/update', [App\Http\Controllers\HomeController::class, 'companyUpdate'])->name('company.update');
Route::get('/home/listing', [App\Http\Controllers\HomeController::class, 'index'])->name('home.listing');
Route::delete('/company/destory/{id}', [App\Http\Controllers\HomeController::class, 'companyDestory'])->name('company.destory');
Route::resource('home', HomeController::class);


// Professional Detail routes
Route::get('/professional/create', [ProfessionalController::class, 'create'])->name('professional.create');
Route::delete('/professional/destory/{id}', [ProfessionalController::class, 'destroy'])->name('professional.destory');
Route::get('/professional/list', [ProfessionalController::class, 'index'])->name('professional.list');
Route::resource('professional', ProfessionalController::class);




