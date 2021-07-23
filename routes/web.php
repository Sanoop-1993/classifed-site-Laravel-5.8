<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[UserController::class,'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/usercontroller/fetch', [App\Http\Controllers\UserController::class, 'fetch'])->name('searchlocation.fetch');
//For Displaying Cities in text
Route::post('/usercontroller/cities', [App\Http\Controllers\UserController::class, 'cities'])->name('state.cities');
//fetch Categories
Route::post('/usercontroller/retrieve', [App\Http\Controllers\UserController::class, 'retrieve'])->name('categories.retrieve');
//display select your category
Route::get('post-classified-add', [App\Http\Controllers\UserController::class,'postad']);
//display various views when category clicked
Route::get('/post-classify-ad/{maincategory}/{id}', [App\Http\Controllers\UserController::class,'categories']);

//To post or publish ads
Route::post('/postCarsBikes', [App\Http\Controllers\UserController::class,'postCarsBikes']);

//to fetch all ads
Route::get('/usercontroller/getAds', [App\Http\Controllers\UserController::class, 'getAds'])->name('categories.ads');

//view Ads By Category
Route::get('/viewAds/{maincategory}/{id}', [App\Http\Controllers\UserController::class,'viewAds']);

//search by product name
Route::post('/product/search', [App\Http\Controllers\UserController::class,'searchProduct']);

//search by category & City name
Route::post('/search/ads', [App\Http\Controllers\UserController::class,'searchAdvertisements']);

//view product details
Route::get('/product/view/{id}', [App\Http\Controllers\UserController::class,'viewProduct']);