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


// Route::post('email/verification-notification',)

Route::post('/login',[\App\Http\Controllers\Api\AuthController::class,'login']);
Route::post('/register',[\App\Http\Controllers\Api\AuthController::class,'register']);

Route::group(['middleware' => 'auth:api'], function() {
    //logout
    Route::post('logout',[\App\Http\Controllers\Api\AuthController::class,'logout']);
    Route::post('/lock/{id}',[\App\Http\Controllers\Api\AuthController::class,'lockAccount']);
    Route::post('/unlock/{id}',[\App\Http\Controllers\Api\AuthController::class,'unlockAccount']);

    //common
    Route::get('/common',[\App\Http\Controllers\Api\CommonController::class,'common']);

    //account
    Route::get('/account',[\App\Http\Controllers\Api\AuthController::class,'GetAccountLogin']);

    //post
    Route::group(['prefix' => 'post'], function () {
        Route::get('/get-list',[\App\Http\Controllers\Api\PostController::class,'getAll']);
        Route::get('/show-approval/{id}',[\App\Http\Controllers\Api\PostController::class,'showApproval']);
        Route::get('/',[\App\Http\Controllers\Api\PostController::class,'getListApproved']);
        Route::post('/',[\App\Http\Controllers\Api\PostController::class,'store']);
        Route::get('/create',[\App\Http\Controllers\Api\PostController::class,'create']);
        Route::get('/search-result',[\App\Http\Controllers\Api\PostController::class,'SearchPost']);
        Route::get('/detail/{id}',[\App\Http\Controllers\Api\PostController::class,'detail']);
        Route::post('/update/{id}',[\App\Http\Controllers\Api\PostController::class,'update']);
        Route::delete('/{id}',[\App\Http\Controllers\Api\PostController::class,'delete']);
        Route::post('/approval',[\App\Http\Controllers\Api\PostController::class,'listApproval']);
        Route::post('/approve/{id}',[\App\Http\Controllers\Api\PostController::class,'approve']);     
        Route::get('/list-favourite',[\App\Http\Controllers\Api\PostController::class,'GetListFavourite']);     
        Route::get('/my-post',[\App\Http\Controllers\Api\PostController::class,'MyPost']);     
        Route::get('/your-post/{id}',[\App\Http\Controllers\Api\PostController::class,'YourPost']);
            
    });

    //categories
    Route::group(['prefix' => 'category'], function () {
        Route::get('/post-by-category',[\App\Http\Controllers\Api\CategoryController::class,'getPostByCategory']);
        Route::get('/',[\App\Http\Controllers\Api\CategoryController::class,'getAll']);
        Route::post('/',[\App\Http\Controllers\Api\CategoryController::class,'store']);
        Route::get('/detail/{id}',[\App\Http\Controllers\Api\CategoryController::class,'show']);
        Route::post('/{id}',[\App\Http\Controllers\Api\CategoryController::class,'updateCategory']);
        Route::delete('/{id}',[\App\Http\Controllers\Api\CategoryController::class,'delete'])->name('category.delete');

    });

    
    //rate
    Route::group(['prefix' => 'rate'], function () {
        Route::post('/{id}',[\App\Http\Controllers\Api\RateController::class,'ratePost']);
        Route::get('/list-rate/{id}',[\App\Http\Controllers\Api\RateController::class,'listRate']);
        Route::get('/rate-detail/{id}',[\App\Http\Controllers\Api\RateController::class,'detail']);
        Route::post('/update-rate/{id}',[\App\Http\Controllers\Api\RateController::class,'updateRate']);
        Route::delete('/delete/{id}',[\App\Http\Controllers\Api\RateController::class,'delete']);
        Route::get('/',[\App\Http\Controllers\Api\RateController::class,'getAll']);
        Route::get('/stat-rate/{id}',[\App\Http\Controllers\Api\RateController::class,'StatRate']);
    });

    //member
    Route::group(['prefix' => 'member'], function () {
        Route::get('/',[\App\Http\Controllers\Api\MemberController::class,'getAll']);
        Route::get('/detail/{id}',[\App\Http\Controllers\Api\MemberController::class,'detail']);
        Route::post('/{id}',[\App\Http\Controllers\Api\MemberController::class,'updateMember']);
        Route::get('/posts',[\App\Http\Controllers\Api\MemberController::class,'PostsByMember']);
        Route::get('/member-detail/{id}',[\App\Http\Controllers\Api\MemberController::class,'memberDetail']);
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

    //banner

    Route::group(['prefix' => 'banner'], function () {
        Route::get('/get-all',[\App\Http\Controllers\Api\BannerController::class,'getAll']);
        Route::get('/detail/{id}',[\App\Http\Controllers\Api\BannerController::class,'bannerDetail']);
        Route::get('/banner-user',[\App\Http\Controllers\Api\BannerController::class,'bannerUser']);
    
        Route::post('/create',[\App\Http\Controllers\Api\BannerController::class,'store']);
        Route::post('/update/{id}',[\App\Http\Controllers\Api\BannerController::class,'updateBanner']);
        Route::delete('/delete/{id}',[\App\Http\Controllers\Api\BannerController::class,'deleteBanner']);
        // Route::post('/lock/{id}',[\App\Http\Controllers\Api\BannerController::class,'store']);
        // Route::post('/unlock/{id}',[\App\Http\Controllers\Api\BannerController::class,'store']);

    });

    // dashboard

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/star-rate',[\App\Http\Controllers\Api\DashboardController::class,'StarRate']);
    });

    //chat

    // Route::group(['prefix' => 'chat'], function () {
    //     Route::get('/rooms',[\App\Http\Controllers\Api\ChatController::class,'rooms']);
    //     Route::get('/room/messages/{roomId}',[\App\Http\Controllers\Api\ChatController::class,'messages']);
    //     Route::post('/room/message/{roomId}',[\App\Http\Controllers\Api\ChatController::class,'newMessage']);

    // });

    Route::group(['prefix' => 'comment'], function () {
        Route::get('/get-comment/{id}',[\App\Http\Controllers\Api\CommentController::class,'getByPostId']);
        Route::post('/post/{id}',[\App\Http\Controllers\Api\CommentController::class,'Comment']);
        Route::post('/reply/{id}',[\App\Http\Controllers\Api\CommentController::class,'Reply']);
        

    });


});
