<?php

use App\Http\Controllers\Api\CrudInvoiceApiController;
use App\Http\Controllers\Api\CrudQuotationApiController;
use App\Http\Controllers\Api\EditProfileApi;
use App\Http\Controllers\Api\LayananApi;
use App\Http\Controllers\Api\LoketApi;
use App\Http\Controllers\Api\UmumApi;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/view_invoice/{vtoken}', [CrudInvoiceApiController::class, 'viewInvoice']);
Route::get('/view_quotation/{vtoken}', [CrudQuotationApiController::class, 'viewQuotation']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    // refresh token
    Route::post('refresh', [AuthController::class, 'refresh']);
});

// Users Controller
Route::group([

    'middleware' => 'jwt.auth',
    'prefix' => 'users',

], function ($router) {

    Route::get('/', [UserApiController::class, 'index']);
    Route::get('/{id}', [UserApiController::class, 'show']);
    Route::post('/', [UserApiController::class, 'store']);
    Route::put('/{id}', [UserApiController::class, 'update']);
    Route::delete('/{id}', [UserApiController::class, 'destroy']);
});
// EditProfile Controller
Route::group([

    'middleware' => 'jwt.auth',
    'prefix' => 'edit_profile',

], function ($router) {

    Route::get('/', [EditProfileApi::class, 'show']);
    Route::post('/', [EditProfileApi::class, 'update']);
    Route::post('/{id}', [EditProfileApi::class, 'updateById']);
    Route::put('/password/{id}', [EditProfileApi::class, 'updatePasswordById']);
    Route::put('/password', [EditProfileApi::class, 'updatePassword']);

});

// route group for middleware jwt

// Layanan Controller
Route::group([

    'middleware' => 'jwt.auth',
    'prefix' => 'layanan',

], function ($router) {

    Route::get('/', [LayananApi::class, 'index']);
    Route::get('/{id}', [LayananApi::class, 'show']);
    Route::post('/', [LayananApi::class, 'create']);
    Route::put('/{id}', [LayananApi::class, 'update']);
    Route::delete('/{id}', [LayananApi::class, 'destroy']);
});

// Loket Controller
Route::group([

    'middleware' => 'jwt.auth',
    'prefix' => 'loket',

], function ($router) {

    Route::get('/', [LoketApi::class, 'index']);
    Route::get('/{id}', [LoketApi::class, 'show']);
    Route::post('/', [LoketApi::class, 'create']);
    Route::put('/{id}', [LoketApi::class, 'update']);
    Route::delete('/{id}', [LoketApi::class, 'destroy']);
});

// Umum Controller
Route::group([

    'middleware' => 'jwt.auth',
    'prefix' => 'umum',

], function ($router) {

    Route::get('/', [UmumApi::class, 'index']);
    Route::post('/{id}', [UmumApi::class, 'update']);
});
