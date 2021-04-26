<?php

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

Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index'])->name('site.home.index');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home.index');
    Route::group(['as' => 'balance.', 'prefix' => 'balance'], function(){
        Route::get('/', [App\Http\Controllers\Admin\BalanceController::class, 'index'])->name('index');
        Route::group(['as' => 'deposit.', 'prefix' => "deposit"], function(){
            Route::get('/balance', [App\Http\Controllers\Admin\Balance\DepositController::class, 'index'])->name('index');
            Route::post('/balance', [App\Http\Controllers\Admin\Balance\DepositController::class, 'store'])->name('store');
        });
        Route::group(['as' => 'withdraw.', 'prefix' => "withdraw"], function(){
            Route::get('/balance', [App\Http\Controllers\Admin\Balance\WithdrawController::class, 'index'])->name('index');
            Route::post('/balance', [App\Http\Controllers\Admin\Balance\WithdrawController::class, 'store'])->name('store');
        });
    });
});
