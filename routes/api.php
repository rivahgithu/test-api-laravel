<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/listproduit', [ProduitController::class, 'listproduit']);
    Route::post('/createproduit', [ProduitController::class, 'save']);
});

Route::get('/', [CategoryController::class, 'index']);
Route::post('/createcategory', [CategoryController::class, 'create']);
Route::delete('/deletecategory/{id}', [CategoryController::class, 'deletecategory']);



Route::delete('/deleteproduit/{id}', [ProduitController::class, 'deleteproduct']);
Route::post('/updateproduit/{id}', [ProduitController::class, 'update']);

//Route de connection et de creation des utilisateurs
Route::post('/createuser', [AuthController::class, 'addusers']);
Route::post('/uathuser', [AuthController::class, 'login']);