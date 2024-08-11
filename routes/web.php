<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(InvoiceController::class)->group(function(){
    Route::get('/invoices', 'index')->name('invoices'); 
    Route::get('invoice/create', 'create')->name('invoice.create');
    Route::get('invoice/edit/{id}', 'edit')->name('invoice.edit');
    Route::post('invoice', 'store')->name('invoice.store');
    Route::get('invoice/{id}', 'show')->name('invoice.show');
    Route::put('invoice/{id}', 'update')->name('invoice.update');
    Route::delete('invoice/{id}', 'destroy')->name('invoice.destroy');
});