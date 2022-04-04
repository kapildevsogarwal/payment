<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;

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



//Route::get('payment-razorpay', 'PaymentController@create')->name('paywithrazorpay');
Route::get('payment-user', [PaymentController::class, 'create'])->name('paywithrazorpay');
Route::post('payment', [PaymentController::class, 'payment'])->name('payment');

Route::get('/subscription/create', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.create');
Route::get('/subscription/company/create', [App\Http\Controllers\SubscriptionController::class, 'companyCreate'])->name('subscription.company.create');
Route::get('/subscription/company/order-post', [App\Http\Controllers\SubscriptionController::class, 'companyPost'])->name('subscription.company.order.post');
#Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
#Route::post('order-post', ['as'=>'order-post','uses'=>'SubscriptionController@orderPost'])->name('order-post');
Route::post('order-post', [App\Http\Controllers\SubscriptionController::class, 'orderPost'])->name('order.post');
Route::post('order-company', [App\Http\Controllers\SubscriptionController::class, 'orderCompany'])->name('order.company');

Route::get('/payment', [App\Http\Controllers\HomeController::class, 'index'])->name('payment');
Route::post('/process', [App\Http\Controllers\SubscriptionController::class, 'paymentAction'])->name('payment_process');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('cart/make-payment', [App\Http\Controllers\HomeController::class, 'makeOrderPayment'])->name('cart.make-payment');
Route::get('/company/add', [App\Http\Controllers\HomeController::class, 'companyAdd'])->name('company.add');
Route::post('company/store', [App\Http\Controllers\HomeController::class, 'companySave'])->name('company.store');
Route::get('/company', [App\Http\Controllers\HomeController::class, 'listCompany'])->name('company.list');
Route::get('company/details/{id}', [App\Http\Controllers\HomeController::class, 'showCompany'])->name('company.details');
Route::get('profile/{id}/user', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.user');
Route::get('company/approval', [App\Http\Controllers\HomeController::class, 'CompanyApprovalAdmin'])->name('company.admin-approval');
Route::get('professional/approval', [App\Http\Controllers\HomeController::class, 'ProfessionalApprovalAdmin'])->name('professional.admin-approval');
Route::get('company/{id}/edit', [App\Http\Controllers\HomeController::class, 'editCompany'])->name('company.edit');
Route::put('/company/{id}/update', [App\Http\Controllers\HomeController::class, 'companyUpdate'])->name('company.update');
Route::get('/home/listing', [App\Http\Controllers\HomeController::class, 'index'])->name('home.listing');
Route::delete('/company/destory/{id}', [App\Http\Controllers\HomeController::class, 'companyDestory'])->name('company.destory');
Route::get('company/show-approval/{id}', [App\Http\Controllers\HomeController::class, 'showCompanyApproval'])->name('company.show-approval');
Route::get('student/search-student', [App\Http\Controllers\HomeController::class, 'studentSearch'])->name('student.searching');
Route::get('company/search-company', [App\Http\Controllers\HomeController::class, 'companySearch'])->name('company.searching');
Route::resource('home', HomeController::class);


// Professional Detail routes
Route::get('/professional/create', [ProfessionalController::class, 'create'])->name('professional.create');
Route::delete('/professional/destory/{id}', [ProfessionalController::class, 'destroy'])->name('professional.destory');
Route::get('/professional/list', [ProfessionalController::class, 'index'])->name('professional.list');
Route::get('professional/search-professional', [App\Http\Controllers\ProfessionalController::class, 'professionalSearch'])->name('professional.searching');
Route::resource('professional', ProfessionalController::class);

Route::get('/search/professional', [SearchController::class, 'searchProfessional'])->name('search.professional');

Route::get('/search/company', [SearchController::class, 'searchCompany'])->name('search.company');
Route::get('search/search-query', [App\Http\Controllers\SearchController::class, 'companySearch'])->name('search.company-list');
Route::get('search/search-query-professional', [App\Http\Controllers\SearchController::class, 'professionalSearch'])->name('search.professional-list');
Route::get('/search/professional/show/{id}', [SearchController::class, 'showProfessional'])->name('search.show-professional');

Route::get('/search/company/show/{id}', [SearchController::class, 'showCompany'])->name('search.show-company');

Route::post('/search/company-approve/{id}', [SearchController::class, 'companyApproveRequest'])->name('search.approve-request');
Route::post('/search/admin-approve/{id}', [SearchController::class, 'companyApproveByAdmin'])->name('search.approve-admin');

Route::post('/search/professional-approve/{id}', [SearchController::class, 'professionalApproveRequest'])->name('search.approve-request-admin');

Route::post('/search/professional-admin-approve/{id}', [SearchController::class, 'professionalApproveByAdmin'])->name('search.professional-approve-admin');
Route::resource('search', SearchController::class);




