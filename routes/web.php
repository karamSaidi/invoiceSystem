<?php


Route::get('/change-locale/{locale}', 'GeneralController@change_locale')->name('change_locale');

Route::get('/', 'InvoiceController@index')->name('invoice');
Route::get('/create', 'InvoiceController@create')->name('invoice.create');
Route::post('/store', 'InvoiceController@store')->name('invoice.store');
Route::get('/show/{id}', 'InvoiceController@show')->name('invoice.show');
Route::get('/print/{id}', 'InvoiceController@print')->name('invoice.print');
Route::get('/pdf/{id}', 'InvoiceController@pdf')->name('invoice.pdf');
Route::get('/send-email/{id}', 'InvoiceController@sendEmail')->name('invoice.sendEmail');
Route::get('/edit/{id}', 'InvoiceController@edit')->name('invoice.edit');
Route::put('/update/{id}', 'InvoiceController@update')->name('invoice.update');
Route::delete('/delete/{id}', 'InvoiceController@delete')->name('invoice.delete');






// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
