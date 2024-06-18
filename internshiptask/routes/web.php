<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CounterpartyController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AutosaveController;

use App\Models\Counterparty;
use App\Models\Product;

Route::get('/', function () {
   $counterparties = Counterparty::all();
   $products = Product::all();
   return view('pages.home', compact('counterparties', 'products'));
})->name('home');

Route::resource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{id}','ProductController@update');
Route::get('/products/{id}/edit', 'ProductController@edit');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::resource('counterparties', CounterpartyController::class);
Route::get('/counterparties', [CounterpartyController::class, 'index'])->name('counterparties');
Route::delete('/counterparties/{counterparty}', [CounterpartyController::class, 'destroy'])->name('counterparties.destroy');
Route::put('/counterparties/{id}','CounterpartyController@update');
Route::get('/counterparties/{id}/edit', 'CounterpartyController@edit');

Route::resource('sales', SalesController::class);
Route::get('/sales', [SalesController::class, 'index'])->name('sales');
Route::delete('/sales/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');
Route::get('products/{id}', [SalesController::class, 'show'])->name('products.show');
Route::put('/sales/{id}','SalesController@update');
Route::get('/sales/{id}/edit', 'SalesController@edit');

Route::post('/autosave', [AutosaveController::class, 'store'])->name('autosave.store');