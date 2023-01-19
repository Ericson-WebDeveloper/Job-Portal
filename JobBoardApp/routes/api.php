<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchContorller;
use App\Http\Controllers\SubcriptionController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::middleware('auth:sanctum')->get('/user-verify', function (Request $request) {
    $user = $request->user();
    $authenticate = $user ? true : false;
    return response()->json([
        'authenticate' => $authenticate,
        'user' => $user
    ]);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('user')->group(function() {
        Route::get('/details', [UserController::class, 'index']);
        Route::post('/save-details', [UserController::class, 'store']);
        Route::put('/update-details', [UserController::class, 'update']);
        Route::put('/update-job-exp', [UserController::class, 'updateJob']);
        Route::put('/update-password', [UserController::class, 'updatePassword']);
        Route::put('/update-image', [UserController::class, 'profileUpdate']);

        Route::middleware(['role:user'])->group(function() {
            Route::post('/application-submit', [JobApplicationController::class, 'submitApplication']);
            //Route::get('/application-check', [JobApplicationController::class, 'checkApplication']);
            Route::get('/user-application/list', [JobApplicationController::class, 'userListApplication']);
            Route::get('/user-application/dashboard-count', [UserController::class, 'dashboardApplication']);
        });
        
    });

    
    Route::prefix('company')->group(function() {
        Route::middleware(['role:employeer', 'is_subcribed'])->group(function () {
           Route::get('/details', [CompanyController::class, 'index']); 
           Route::post('/save-details', [CompanyController::class, 'store']); 
           Route::put('/update-details/{id}', [CompanyController::class, 'update']); 
           Route::put('/update/other-data/{id}', [CompanyController::class, 'updateAddtionalData']); 
           Route::put('/update/company-image/{id}', [CompanyController::class, 'updateCompanyImage']);
        });
    });

    Route::prefix('subcription')->group(function() {
        Route::middleware(['role:employeer'])->group(function () {
           Route::post('/stripe-payment/option', [PaymentController::class, 'stripePayment']); 
           Route::post('/stripe-payment/option/authenticate', [PaymentController::class, 'stripePaymentAuth']); 
           Route::post('/stripe-payment/option/cancel', [PaymentController::class, 'stripePaymentAuth']); 

           Route::post('/paypal-payment/option', [PaymentController::class, 'paypalPayment']);
           Route::post('/paypal-payment/complete', [PaymentController::class, 'paypalPaymentConfirm']);
           Route::post('/paypal-payment/confirmData', [PaymentController::class, 'confirmData']);
        });
    });

    Route::prefix('application')->group(function() {
        Route::middleware(['role:employeer', 'is_subcribed'])->group(function () {
            Route::put('/update/status/{id}', [JobApplicationController::class, 'updateApplicationStatus']);
            Route::post('/cv/download', [JobApplicationController::class, 'downloadCSV']);
            Route::get('/new/{id}', [JobApplicationController::class, 'newApplications']);
        });
    });

    Route::prefix('employeer_subcription')->group(function() {
        Route::middleware(['role:employeer'])->group(function () {
            Route::get('/details', [SubcriptionController::class, 'fetchSubcriptionDetails']);
            Route::get('/checking-details', [SubcriptionController::class, 'checkingSubcription']);
        });
    });
  

    Route::prefix('job')->group(function() {
        Route::middleware(['role:employeer', 'is_subcribed'])->group(function () { // create middleware that check the owner ship of data
            Route::get('/post/{company_id}', [JobController::class, 'show']);
            Route::get('/application/{job_id}', [JobController::class, 'showAllApplications']);
            Route::post('/post', [JobController::class, 'store']);
            Route::put('/update/{id}', [JobController::class, 'update']);
            Route::get('/post-active/count/{id}', [JobController::class, 'jobsActive']);
            Route::get('/post-total/count/{id}', [JobController::class, 'jobsTotal']);
           
        });
    });

    Route::prefix('admin')->group(function() {
        Route::middleware(['role:admin'])->group(function () { 
            Route::get('/users', [AdminController::class, 'users']);
            Route::put('/activate-deactivate/employeer', [AdminController::class, 'updateStatusEmployeer']);
        });
    });
    
    Route::get('/get-user', [UserController::class, 'fetchUser']);
    Route::get('/get-users', [UserController::class, 'users']);
    // Route::get('/get-employeer', [CompanyController::class, 'employeer']);
    Route::get('/get-employeers', [UserController::class, 'fetchEmployeers']);
    Route::get('/get-jobs', [UserController::class, 'fetchJobs']);

    Route::get('/job/get-data/{id}', [JobController::class, 'fetchJob']);

    
});


Route::get('/public/companies-list', [CompanyController::class, 'publicCompanies']);
Route::get('/public/top/companies-list', [CompanyController::class, 'topCompanies']);
Route::get('/public/top/jobs', [JobController::class, 'topJobs']);
Route::get('/public/top/applicants', [JobApplicationController::class, 'topApplicants']);
Route::get('/public/company/{id}', [CompanyController::class, 'publicCompany']);
Route::get('/public/job/{id}', [JobController::class, 'publicJob']);
Route::get('/public/job-company/list/{company}', [JobController::class, 'publicCompanyJobs']);
Route::get('/public/job-vacancy/list', [JobController::class, 'publicVancancyJobs']);

Route::post('/public/searching-job', [JobController::class, 'index']);
Route::get('/public/searching-job', [JobController::class, 'index2']);

Route::post('/public/searching-keyword/auto', [SearchContorller::class, 'autoSearchKeyword']);
Route::post('/public/searching-location/auto', [SearchContorller::class, 'autoSearchLocation']);
Route::post('/public/searching-location/auto', [SearchContorller::class, 'autoSearchLocation']);


Route::get('/specialization/categories', [AuthController::class, 'getSpecializations']);