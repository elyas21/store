<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return redirect('home');    
});


Route::get('/camera', function(){
    return view('guardStaff/camera');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');


Route::get('store/home', 'Store\StoreController@index')->name('store.home')->middleware('store');
Route::get('store/add', 'InventorieController@create')->name('store.add')->middleware('store');
Route::get('store/view', 'InventorieController@showAll')->name('store.view')->middleware('store');

Route::get('store/addEmployee', 'UserController@create')->name('store.AddEmployee')->middleware('store');
Route::post('store/storeEmployee', 'UserController@store')->name('store.storeEmployee')->middleware('store');

Route::get('store/transfer', 'InventorieController@transfer')->name('store.transfer')->middleware('store');
Route::post('store/transfer', 'InventorieController@transferUpdate')->name('store.transfer')->middleware('store');

Route::get('qrGenerate/{id}' , function($id){
    return view('store.qrGenerate' , compact('id'));
})->name('qrGenerate');



Route::get('guardStaff/home', function(){
    return view('guardStaff.home');
})->name('guardStaff.home')->middleware('guardStaff');

Route::get('guardStaff/addInv', 'PersonalInvController@create')->name('guardStaff.addInv')->middleware('guardStaff');
Route::post('guardStaff/addInv', 'PersonalInvController@store')->name('guardStaff.store')->middleware('guardStaff');


Route::get('guardStaff/viewAllInv', 'PersonalInvController@showAll')->name('guardStaff.viewAllInv')->middleware('guardStaff');


Route::get('guard/home', 'Guard\GuardController@index')->name('guard.home')->middleware('guard');
Route::get('guard/scan', 'Guard\GuardController@scan')->name('guard.scan')->middleware('guard');
// Route::post('test-api', 'Guard\GuardController@getInfo')->name('guard.getInfo')->middleware('guard');
Route::get('/getInfo/{id}', 'Guard\GuardController@getInfo')->name('tasks.show');

Route::resource('inventorie','InventorieController');





Route::get('guard/**', function () {
    return redirect('home');    
});