<?php

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Auth;
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

Route::get('/user', function () {
    return view('welcome');
});
Route::post('/broadcasting/auth', function () {
    dd(Auth::user());
    return Auth::user();
 });

//  Route::group(['middleware' => 'auth:api'], function() {
   
//     });
// Route::middleware('auth:api','verified')->get('/home-page',function(){
//     return Inertia\Inertia::render('');
// })->name('home-page');

 Route::group(['middleware' => 'auth:api'], function() {
 Route::group(['prefix' => 'api/chat'], function () {
    Route::get('/rooms',[\App\Http\Controllers\Api\ChatController::class,'rooms']);
    Route::get('/room/messages/{roomId}',[\App\Http\Controllers\Api\ChatController::class,'messages']);
    Route::post('/room/message/{roomId}',[\App\Http\Controllers\Api\ChatController::class,'newMessage']);

});
 });
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
