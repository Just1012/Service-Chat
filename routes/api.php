<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FormServiceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function ($router) {
    // Route::post('/storeOrderForm',[OrderController::class,'storeOrderForm']);
    // User & Auth
  

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/getSlider', [SliderController::class, 'getSlider']);
    // Settings Route
    Route::get('/getSetting', [SettingController::class, 'getSetting']);
    Route::get('/getTerms', [SettingController::class, 'getTerms']);

    // Category Routes
    Route::get('/getCategory', [CategoryController::class, 'getCategory']);
    Route::get('/getCategory/with/services', [CategoryController::class, 'getCategoryServices']);
    Route::post('/storeCategory', [CategoryController::class, 'storeCategory']);
    Route::get('/updateStatus/{category}', [CategoryController::class, 'updateStatus']);
    Route::get('/edit/{category}', [CategoryController::class, 'updateCategory']);

    // Services Route
    Route::post('/storeService', [ServiceController::class, 'storeService']);
    Route::get('/getService/{category}', [ServiceController::class, 'getService']);
    Route::get('/fields/{service}', [FormServiceController::class, 'serviceForm']);


    Route::group(['middleware' => ['jwt.verify', 'api', 'checkUser']], function () {
        // User & Auth
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/change/password', [AuthController::class, 'change_password']);

        // Slider Route
        Route::get('delete/account', [AuthController::class, 'delete_account']);

        // Order Route
        Route::get('/getOrder/{order}', [OrderController::class, 'getOrder']);
        Route::get('/getOrder/for/user', [OrderController::class, 'get_order_user']);

        Route::post('/storeOrderForm', [OrderController::class, 'storeOrderForm']);
        Route::get('/updateOrderStatus/{order}', [OrderController::class, 'updateOrderStatus']);

        Route::get('/getConversation/{id}', [ChatController::class, 'getConversation']);
        Route::post('/send', [ChatController::class, 'sendMessage']);

        Route::get('/getConversationsForUser', [ChatController::class, 'getConversationsForUser']);

    });
});
