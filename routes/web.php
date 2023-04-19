<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrudController;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["verify" => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware("verified");
Route::get("/fillable",[GrudController::class,"getFillable"]);


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

        Route::group(['prefix' => 'offers'], function () {
            //   Route::get('store', 'CrudController@store');
        Route::get("create",[GrudController::class,"create"]);
        Route::get("all",[GrudController::class,"getAllOffers"])->name("offers.all");
        Route::post("store",[GrudController::class,"store"])->name("offers.store");
        Route::get("edit/{offer_id}",[GrudController::class,"editOffer"]);

        Route::post("update/{offer_id}",[GrudController::class,"updateOffer"])->name("offers.update");

        
        });

        Route::get("video",[GrudController::class,"getVideo"]);

    // Route::get("store",[GrudController::class,"store"]);

   


});
