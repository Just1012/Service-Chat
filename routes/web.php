<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\FieldsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\ChatController;
use App\Http\Controllers\FieldOptionController;
use App\Http\Controllers\SettingController;

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

Auth::routes(['register' => false]);
Route::get('/', [HomeController::class, 'welcome'])->name('welcome')->middleware(['auth','ensureSessionIsActive']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth','ensureSessionIsActive']);
Route::get('/payments/verify/{payment?}', [HomeController::class, 'payment_verify'])->name('verify-payment');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');


/////route Category
Route::prefix('category')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/datatable', [CategoryController::class, 'datatable'])->name('category.datatable');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/updateStatus/{category}', [CategoryController::class, 'updateStatus'])->name('category.status');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
});

/////route Service
Route::prefix('service')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index/{category}', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/datatable/{id}', [ServiceController::class, 'datatable'])->name('service.datatable');
    Route::get('/create/{category}', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/updateStatus/{service}', [ServiceController::class, 'updateStatus'])->name('service.status');
    Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::delete('/delete-image', [ServiceController::class, 'deleteImage'])->name('deleteImage');
});

/////route Fields
Route::prefix('fields')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index', [FieldsController::class, 'index'])->name('field.index');
    Route::get('/datatable', [FieldsController::class, 'datatable'])->name('field.datatable');
    Route::get('/create', [FieldsController::class, 'create'])->name('field.create');
    Route::post('/store', [FieldsController::class, 'store'])->name('field.store');
    Route::get('/updateStatus/{field}', [FieldsController::class, 'updateStatus'])->name('field.status');
    Route::get('/edit/{field}', [FieldsController::class, 'edit'])->name('field.edit');
});

/////route Field Option
Route::prefix('fieldOption')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index/{field}', [FieldOptionController::class, 'index'])->name('fieldOption.index');
    Route::get('/datatable/{id}', [FieldOptionController::class, 'datatable'])->name('fieldOption.datatable');
    Route::get('/create/{field}', [FieldOptionController::class, 'create'])->name('fieldOption.create');
    Route::post('/store', [FieldOptionController::class, 'store'])->name('fieldOption.store');
    Route::get('/edit/{fieldOption}', [FieldOptionController::class, 'edit'])->name('fieldOption.edit');
});

/////route Slider
Route::prefix('slider')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/datatable', [SliderController::class, 'datatable'])->name('slider.datatable');
    Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/updateStatus/{slider}', [SliderController::class, 'updateStatus'])->name('slider.status');
    Route::get('/edit/{slider}', [SliderController::class, 'edit'])->name('slider.edit');
});

/////route User
Route::prefix('users')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index/{role}', [UserController::class, 'index'])->name('user.index');
    Route::get('/datatable/{id}', [UserController::class, 'datatable'])->name('user.datatable');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
});

Route::prefix('orders')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('/datatable/{value?}', [OrderController::class, 'getOrders'])->name('order.admin.datatable');
    Route::get('/getOrderForm/{order}', [OrderController::class, 'getOrderForm'])->name('order.admin.from_data');
    Route::get('/status/{order}', [OrderController::class, 'updateStatus'])->name('order.admin.status');
    Route::get('/updatedelivery/{order}', [OrderController::class, 'updatedelivery'])->name('order.admin.updatedelivery');
});

// Settings Route
Route::prefix('setting')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/systemInfo/update', [SettingController::class, 'updateAllSystemInfo'])->name('setting.updateAllSystemInfo');

    Route::get('/terms/edit', [SettingController::class, 'editTerms'])->name('terms.editTerms');
    Route::post('/terms/update', [SettingController::class, 'updateTerms'])->name('terms.updateTerms');

    // Route::get('/datatable', [SettingController::class, 'datatable'])->name('setting.datatable');
    // Route::get('/create', [SettingController::class, 'create'])->name('setting.create');
    // Route::post('/store', [SettingController::class, 'store'])->name('setting.store');
    // Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('setting.edit');
});

// Chat Route
Route::prefix('chat')->middleware(['auth','ensureSessionIsActive'])->group(function () {
    Route::get('/index/{id}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/send', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::get('/lockChat/{id}', [ChatController::class, 'lockChat'])->name('chat.lock'); // update order status to lock chat
});


