<?php

use App\Http\Controllers\api\ApiauthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




use App\Http\Controllers\ApiProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();});
Route::post('/postRegister', [ApiauthController::class, 'postRegister']);
Route::post('/login', [ApiauthController::class, 'login']);
Route::put('/{id}/update', [ApiauthController::class, 'update']);
Route::post('/checkforgotpassword', [ApiauthController::class, 'check_forgot_password']);
Route::post('/resetpassword/{token}', [ApiauthController::class, 'check_reset_password']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('subcategories', SubcategoryController::class);
Route::apiResource('promotions', PromotionController::class);
// Route tùy chỉnh để áp dụng khuyến mãi
Route::post('/promotions/apply', [PromotionController::class, 'applyPromotion']);
