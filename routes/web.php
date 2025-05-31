<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoomChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login.page');
});

Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');
    Route::get('/register-guru',[AuthController::class,'registerGuru'])->name('register.guru');
    Route::get('/register-murid',[AuthController::class,'registerMurid'])->name('register.murid');
    Route::post('/check', [AuthController::class, 'login'])->name('login.check');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('/guru/{user_id}')->group(function () {
    Route::get('/chat', [GuruController::class, 'chat'])->name('guru.dashboard');
    Route::get('/permintaan', [GuruController::class, 'permintaan'])->name('guru.permintaan');
    Route::get('/profile', [GuruController::class, 'profile'])->name('guru.profile');
    Route::get('/chat/{room_id}', [GuruController::class, 'chat'])->name('guru.chat');
});

Route::prefix('/murid/{user_id}')->group(function () {
    Route::get('/dashboard', [MuridController::class, 'dashboard'])->name('murid.dashboard');
    Route::get('/chat', [MuridController::class, 'chat'])->name('murid.chat');
    Route::get('/permintaan', [MuridController::class, 'permintaan'])->name('murid.permintaan');
    Route::get('/profile', [MuridController::class, 'profile'])->name('murid.profile');
    Route::get('/detail', [MuridController::class, 'profile'])->name('murid.profile');
});

Route::prefix('/admin')->group(function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/daftar-guru',[AdminController::class,'daftarGuru'])->name('admin.daftar-guru');
    Route::get('/daftar-murid',[AdminController::class,'daftarMurid'])->name('admin.daftar-murid');
    Route::get('/daftar-chat',[AdminController::class,'daftarChat'])->name('admin.daftar-chat');
});

Route::prefix('/room-chat/{room_chat_id}')->group(function () {
    Route::get('/selesai', [RoomChatController::class, 'selesai'])->name('room-chat.selesai');
});

Route::prefix('/request')->group(function(){
    Route::post('/create',[RequestController::class,'create'])->name('request.create');
    Route::post('/{request_id}/rejected',[RequestController::class,'rejected'])->name('request.rejected');
    Route::post('/{request_id}/accepted',[RequestController::class,'accepted'])->name('request.accepted');
});

Route::prefix('/chat')->group(function(){
    Route::post('/create',[ChatController::class,'create'])->name('chat.create');
});