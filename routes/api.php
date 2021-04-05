<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tables\TablesController;
use App\Http\Controllers\UserPersonalDataController;

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

Route::group([
    'prefix' => 'v1/auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [UserController::class, 'retrieveInfo']);
    });
});

Route::group([
    'prefix' => 'v1/manage'
], function () {

    Route::get('/tables/public', [TablesController::class, 'showPublic']);
    Route::get('/tables/public/details', [TablesController::class, 'showPublicDetails']);

    Route::get('/tables', [TablesController::class, 'showAll']);


    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/tables/private', [TablesController::class, 'showPrivate']);
    });
});

Route::group([
    'prefix' => 'v1/user',
    'middleware' => 'auth:api'
] , function () {

    Route::group([
        'prefix' => '/avatar'
    ], function () {
        Route::post('/post',[UserPersonalDataController::class,'postAvatar']);
        Route::get('',[UserPersonalDataController::class,'getAvatar']);
        Route::delete('/delete',[UserPersonalDataController::class,'deleteAvatar']);
    });

    Route::group([
        'prefix' => '/address'
    ], function () {
        Route::get('',[UserPersonalDataController::class, 'getAddress']);
        Route::put('/update',[UserPersonalDataController::class, 'updateAddress']);
        Route::delete('/delete',[UserPersonalDataController::class, 'deleteAddress']);
    });

    Route::group([
        'prefix' => '/regulation'
    ], function () {
        Route::get('',[UserPersonalDataController::class,'isRegulationAccepted']);
        Route::put('/update',[UserPersonalDataController::class,'setRegulationAcceptance']);
    });
});
