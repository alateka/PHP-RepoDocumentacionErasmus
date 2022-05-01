<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ListadoController;
use App\Http\Controllers\SolicitudController;
use App\Mail\RegisterMailable;
use Illuminate\Support\Facades\Mail;



use App\Models\User;
use Illuminate\Http\Request;


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


//Rutas públicas
Route::get('/', function () {
    return view('welcome');
});
Route::get('/faq', [InfoController::class, 'faq'])->name('info.faq');
Route::get('/documentos',[InfoController::class, 'doc'])->name('info.documentos');
Route::get('/listados', [InfoController::class, 'lists'])->name('info.listados');
Route::get('/not-verify', [LoginController::class, 'notVerify'])->name('user.notverify');


//Rutas de usuarios verificados
Route::group(['middleware' => 'verify'], function () {
    Route::get('/home', [LoginController::class, 'index'])->name('home');
    Route::post('/solicitud',[SolicitudController::class, 'createSolicitud'])->name('solicitud.create');
    Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud');
    Route::get('/solicitud/documentos', [DocumentoController::class, 'documentos'])->name('solicitud.documentos');
    Route::delete('/documentos/delete{documento}', [DocumentoController::class, 'delete'])->name('documents.delete');
    Route::delete('/solicitud/{solicitud}', [SolicitudController::class, 'delete'])->name('solicitud.delete');
    Route::post('/solicitud/update/{solicitud}',[SolicitudController::class, 'updateSolicitud'])->name('solicitud.update');
    Route::post('/solicitud/update',[SolicitudController::class, 'updateSolicitudByUser'])->name('solicitud.updateUser');
    Route::post('/documentos',[DocumentoController::class, 'store'])->name('documentos.store');
    Route::post('/user/profile', [UserController::class, 'updateByUsuario'])->name('users.updateUser');
    Route::get('/solicitud/documentos/download/{solicitud}', [DocumentoController::class, 'download'])->name('documents.download');
});


//Rutas de usuario administrador
Route::group(['middleware' => 'admin'], function () {
    Route::delete('/home/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::delete('/admin/validate-users/{user}', [UserController::class, 'delete'])->name('users.unvalidate');
    Route::patch('/admin/validate-users/{user}', [AdminController::class, 'verify'])->name('users.verify');
    Route::get('/admin/validate-users', [AdminController::class, 'validateUsers'])->name('admin.validate');
    Route::get('/admin/listados', [AdminController::class, 'listados'])->name('admin.listados');
    Route::get('/admin/listados/generate', [ListadoController::class, 'generatePDF'])->name('listados.generate');
    Route::get('/admin/solicitud/{user}', [AdminController::class, 'showSolicitud'])->name('admin.solicitud');
});
