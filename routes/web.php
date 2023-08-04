<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMidleware;
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



Route::controller(UserController::class)->group(function(){
  
 Route::post('/user-register','UserRegister');
 Route::post('/user-login','UserLogin');
 Route::post('/sent-otp','SentOTPCode');
 Route::post('/verify-otp','VerifyOTP');
 //Token verify korte hobe
 Route::post('/reset-password','ResetPassword')->middleware(TokenVerificationMidleware::class);
 Route::get('/logout','UserLogout');  
 Route::get('/user-profile','UserProfile')->middleware(TokenVerificationMidleware::class);
 Route::post('/user-update','UpdateUserProfile')->middleware(TokenVerificationMidleware::class);
 
 
 //page routes
 //after authentication
 
 Route::get('/userLogin', 'LoginPage');
 Route::get('/userRegistration', 'RegisterationPage');
 Route::get('/sendOtp', 'SendOtpPage');
 Route::get('/verifyOtp', 'VerifyOTPPage');
 Route::get('/resetPassword', 'ResetPasswordPage')->middleware(TokenVerificationMidleware::class);
Route::get('/dashboard', 'DashboardPage')->middleware(TokenVerificationMidleware::class);
Route::get('/profileDetails','ProfilePage')->middleware(TokenVerificationMidleware::class);
Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware(TokenVerificationMidleware::class);
Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware(TokenVerificationMidleware::class);
Route::get('/productPage',[ProductController::class,'ProductPage'])->middleware(TokenVerificationMidleware::class);



});
//Customer API
Route::post('/create-customer',[CustomerController::class,'CustomerCreate'])->middleware(TokenVerificationMidleware::class);
Route::get('/customer-list',[CustomerController::class,'CustomerList'])->middleware(TokenVerificationMidleware::class);
Route::post('/delete-customer',[CustomerController::class,'CustomereDelete'])->middleware(TokenVerificationMidleware::class);
Route::post('/update-customer',[CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationMidleware::class);
Route::post('/customer-by-id',[CustomerController::class,'CustomerByID'])->middleware(TokenVerificationMidleware::class);
Route::post('/total-customer',[CustomerController::class,'Total_Customer'])->middleware(TokenVerificationMidleware::class);

//catagory Api
Route::post('/create-category',[CategoryController::class,'Create_Category'])->middleware(TokenVerificationMidleware::class);
Route::get('/catagory-list',[CategoryController::class,'Category_List'])->middleware(TokenVerificationMidleware::class);
Route::post('/update-category',[CategoryController::class,'Update_Category'])->middleware(TokenVerificationMidleware::class);
Route::post('/delete-category',[CategoryController::class,'Delete_Category'])->middleware(TokenVerificationMidleware::class);
Route::get('/total-category',[CategoryController::class,'Total_Category'])->middleware(TokenVerificationMidleware::class);

//Product Api
Route::post('/create-product',[ProductController::class,'Create_Product'])->middleware(TokenVerificationMidleware::class);
Route::get('/product-list',[ProductController::class,'ProductList'])->middleware(TokenVerificationMidleware::class);
Route::post('/update-product',[ProductController::class,'Update_Product'])->middleware(TokenVerificationMidleware::class);
Route::post('/delete-product',[ProductController::class,'Delete_Product'])->middleware(TokenVerificationMidleware::class);
Route::get('/total-product',[ProductController::class,'Total_Product'])->middleware(TokenVerificationMidleware::class);

//Dashboard API
Route::get('/total-customer',[DashboardController::class,'TotalCustomer'])->middleware(TokenVerificationMidleware::class);
Route::get('/total-category',[DashboardController::class,'TotalCategory'])->middleware(TokenVerificationMidleware::class);
Route::get('/total-product',[DashboardController::class,'TotalProduct'])->middleware(TokenVerificationMidleware::class);
