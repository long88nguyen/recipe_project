<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test-api', [\App\Http\Controllers\Api\TestApiController::class,'index']);
Route::post('test-api', [\App\Http\Controllers\Api\TestApiController::class,'store']);
Route::put('test-api/{id}', [\App\Http\Controllers\Api\TestApiController::class,'update']);
Route::get('test-api/{id}', [\App\Http\Controllers\Api\TestApiController::class,'show']);
Route::delete('test-api/{id}', [\App\Http\Controllers\Api\TestApiController::class,'delete']);




Route::post('/login',[\App\Http\Controllers\Api\AuthController::class,'login']);
Route::post('/register',[\App\Http\Controllers\Api\AuthController::class,'register']);

Route::group(['middleware' => 'auth:api'], function() {
    //logout
    Route::post('logout',[\App\Http\Controllers\Api\AuthController::class,'logout']);

    //common
    Route::get('/common',[\App\Http\Controllers\Api\CommonController::class,'common']);

    //post
    Route::group(['prefix' => 'post'], function () {
        Route::get('/get-list',[\App\Http\Controllers\Api\PostController::class,'getAll']);
        Route::get('/show-approval/{id}',[\App\Http\Controllers\Api\PostController::class,'showApproval']);
        Route::get('/',[\App\Http\Controllers\Api\PostController::class,'getListApproved']);
        Route::post('/',[\App\Http\Controllers\Api\PostController::class,'store']);
        Route::get('/create',[\App\Http\Controllers\Api\PostController::class,'create']);
        Route::get('/search-result',[\App\Http\Controllers\Api\PostController::class,'SearchPost']);
        Route::get('/{id}/edit',[\App\Http\Controllers\Api\PostController::class,'edit']);
        Route::post('/{id}/update',[\App\Http\Controllers\Api\PostController::class,'update']);
        Route::delete('/{id}',[\App\Http\Controllers\Api\PostController::class,'delete']);
        Route::post('/approval',[\App\Http\Controllers\Api\PostController::class,'listApproval']);
        Route::post('/approve/{id}',[\App\Http\Controllers\Api\PostController::class,'approve']);     
    });

    //categories
    Route::group(['prefix' => 'category'], function () {
        Route::get('/',[\App\Http\Controllers\Api\CategoryController::class,'getAll']);
        Route::post('/',[\App\Http\Controllers\Api\CategoryController::class,'store']);
        Route::get('/{id}',[\App\Http\Controllers\Api\CategoryController::class,'show']);
        Route::post('/{id}',[\App\Http\Controllers\Api\CategoryController::class,'updateCategory']);
        Route::delete('/{id}',[\App\Http\Controllers\Api\CategoryController::class,'delete']);
    });

    
    //rate
    Route::group(['prefix' => 'rate'], function () {
        Route::post('/{id}',[\App\Http\Controllers\Api\RateController::class,'ratePost']);
    });

    //favourite
    Route::group(['prefix' => 'favourite'], function () {
        Route::post('/{id}',[\App\Http\Controllers\Api\FavouriteController::class,'favouritePost']);
        Route::delete('/{id}',[\App\Http\Controllers\Api\FavouriteController::class,'unfavouritePost']);
    });

    //ingredient 
     
    Route::group(['prefix' => 'ingredient'], function () {
        Route::get('/',[\App\Http\Controllers\Api\IngredientController::class,'getAll']);
    });

    //direction 
    Route::group(['prefix' => 'direction'], function () {
        Route::get('/',[\App\Http\Controllers\Api\DirectionController::class,'getAll']);
    });

    //post-image 
    Route::group(['prefix' => 'post-image'], function () {
        Route::get('/',[\App\Http\Controllers\Api\PostImageController::class,'getAll']);
    });
});
