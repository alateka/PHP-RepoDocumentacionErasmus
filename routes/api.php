<?php

// Author ==> Alberto Pérez Fructuoso
// File   ==> api.php
// Date   ==> 2022/05/29

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// Public
Route::post('/getoken', [ApiController::class, 'getApiToken']);
Route::post('/login_on_android_app', [ApiController::class, 'loginOnAndroidApp']);

// With Auth
Route::get('/apitest', [ApiController::class, 'apiTest'])->middleware('auth:sanctum');
Route::post('/upload_file', [ApiController::class, 'uploadFileViaApi'])->middleware('auth:sanctum');
Route::get('/getuser_data', [ApiController::class, 'getUserData'])->middleware('auth:sanctum');
Route::get('/document_list', [ApiController::class, 'documentList'])->middleware('auth:sanctum');
Route::post('/update_user', [ApiController::class, 'updateUserViaAPI'])->middleware('auth:sanctum');
Route::get('/cycle_list', [ApiController::class, 'getCycleList'])->middleware('auth:sanctum');
Route::post('/remove_document', [ApiController::class, 'removeFileViaApi'])->middleware('auth:sanctum');
Route::get('/download_document', [ApiController::class, 'downloadDocument'])->middleware('auth:sanctum');

