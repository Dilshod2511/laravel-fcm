<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::controller(ProfileController::class)->group(function () {
       Route::get('/profile', 'edit')->name('profile.edit');
       Route::patch('/profile', 'update')->name('profile.update');
       Route::delete('/profile', 'destroy')->name('profile.destroy');
       Route::put('/profile/fcm', 'updateFcmToken')->name('profile.fcm-update');
   });
    Route::controller(\App\Http\Controllers\NotificationController::class)->group(function () {
        Route::get('/notification/show', 'show')->name('notification.show');
        Route::post('/notification/send', 'send')->name('notification.send');
    }) ;
});


require __DIR__.'/auth.php';
