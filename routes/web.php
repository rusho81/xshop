<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVarificationMiddleware;


//API Route
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])
->middleware([TokenVarificationMiddleware::class]);

Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware([TokenVarificationMiddleware::class]);

//logout
Route::get('/logout',[UserController::class, 'UserLogout']);


//Page Route
Route::get('/userLogin',[UserController::class, 'LoginPage']);
Route::get('/userRegistration',[UserController::class, 'RegistrationPage']);
Route::get('/sendOtp',[UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class, 'VerifyOtpPage']);
Route::get('/resetPassword',[UserController::class, 'ResetPasswordPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class, 'DashboardPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/userProfile',[UserController::class, 'ProfilePage'])->middleware([TokenVarificationMiddleware::class]);

 Route::get('/customerPage',[CustomerController::class, 'CustomerPage'])->middleware([TokenVarificationMiddleware::class]);

//Customer API Route
Route::post('/create-customer',[CustomerController::class, 'CustomerCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/delete-customer',[CustomerController::class, 'CustomerDelete'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/list-customer',[CustomerController::class, 'CustomerList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/update-customer',[CustomerController::class, 'CustomerUpdate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/customer-by-id',[CustomerController::class, 'CustomerById'])->middleware([TokenVarificationMiddleware::class]);

