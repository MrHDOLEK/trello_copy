<?php


use App\Http\Controllers\Admin\ManageArticleCategoriesController;
use App\Http\Controllers\Admin\ManageArticlesController;
use App\Http\Controllers\Admin\ManageArticleTypesController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ManagePacketsController;
use App\Http\Controllers\Admin\ManageTablesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tables\TablesController;
use App\Http\Controllers\UserPersonalDataController;
use App\Http\Controllers\Tables\CardsController;
use App\Http\Controllers\Tables\TaskController;
use App\Http\Controllers\Tables\TeamsController;
use App\Http\Controllers\PayuController;

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

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/tables/private', [TablesController::class, 'showPrivate']);
        Route::get('/tables/private/details', [TablesController::class, 'showPrivateDetails']);
        Route::post('/tables', [TablesController::class, 'create']);
        Route::put('/tables', [TablesController::class, 'update']);
        Route::delete('/tables', [TablesController::class, 'delete']);

        Route::post('/cards', [CardsController::class, 'create']);
        Route::put('/cards', [CardsController::class, 'update']);
        Route::delete('/cards', [CardsController::class, 'delete']);

        Route::post('/tasks', [TaskController::class, 'create']);
        Route::put('/tasks', [TaskController::class, 'update']);
        Route::delete('/tasks', [TaskController::class, 'delete']);

        Route::get('/teams', [TeamsController::class, 'show']);
        Route::post('/teams/assignment', [TeamsController::class, 'assignment']);
        Route::post('/teams', [TeamsController::class, 'create']);
        Route::put('/teams', [TeamsController::class, 'update']);
        Route::delete('/teams', [TeamsController::class, 'delete']);
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

Route::group([
    'prefix' => 'v1/manage',
    'middleware' => 'auth:api'
], function () {

    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::post('/create',[ManageUsersController::class, 'createUser']);
        Route::get('',[ManageUsersController::class,'getUsers']);
        Route::get('/details',[ManageUsersController::class,'getUserDetails']);
        Route::put('/update',[ManageUsersController::class,'updateUser']);
        Route::delete('/delete',[ManageUsersController::class,'deleteUser']);
    });

    Route::group([
        'prefix' => 'portal'
    ], function () {

        Route::group([
            'prefix' => 'packet'
        ], function () {
            Route::post('/create',[ManagePacketsController::class, 'create']);
            Route::get('',[ManagePacketsController::class, 'get']);
            Route::put('/update',[ManagePacketsController::class, 'update']);
            Route::delete('/delete',[ManagePacketsController::class, 'delete']);
        });

        Route::group([
            'prefix' => 'article'
        ], function () {
           Route::post('/create',[ManageArticlesController::class, 'create']);
           Route::get('',[ManageArticlesController::class, 'get']);
           Route::put('/update',[ManageArticlesController::class, 'update']);
           Route::delete('/delete',[ManageArticlesController::class, 'delete']);

           Route::group([
               'prefix' => 'category'
           ], function () {
               Route::post('/create',[ManageArticleCategoriesController::class, 'create']);
               Route::get('',[ManageArticleCategoriesController::class, 'get']);
               Route::put('/update',[ManageArticleCategoriesController::class, 'update']);
               Route::delete('/delete',[ManageArticleCategoriesController::class, 'delete']);
           });

           Route::group([
               'prefix' => 'type'
           ], function () {
               Route::post('/create',[ManageArticleTypesController::class, 'create']);
               Route::get('',[ManageArticleTypesController::class, 'get']);
               Route::put('/update',[ManageArticleTypesController::class, 'update']);
               Route::delete('/delete',[ManageArticleTypesController::class, 'delete']);
           });
        });
    });

    Route::group([
        'prefix' => 'table'
    ], function () {
        Route::post('/create',[ManageTablesController::class, 'create']);
        Route::get('',[ManageTablesController::class, 'get']);
        Route::put('/update',[ManageTablesController::class, 'update']);
        Route::delete('/delete',[ManageTablesController::class, 'delete']);
    });
});
Route::group([
    'prefix' => 'v1/payu'
], function () {
    Route::post('get_order/(?P<id>\d+)', [PayuController::class, 'getOrder']);
    Route::post('get_payment_status/(?P<id>\w+)', [PayuController::class, 'getPaymentStatus']);
});
