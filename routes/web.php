<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\MQTTController;
use App\Http\Controllers\HomeController;

Route::redirect('/', '/home')->name('dashboard');

// To enter middleware user must be authenticated and verified
Route::middleware(['auth', 'verified'])->group(function() {

    // Note Routes
    //Route::get('/note', [NoteController::class, 'index'])->name('note.index');
    //Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    //Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    //Route::get('/note/{note}', [NoteController::class, 'show'])->name('note.show');
    //Route::get('/note/{note}/edit', [NoteController::class, 'edit'])->name('note.edit');
    //Route::put('/note/{note}', [NoteController::class, 'update'])->name('note.update');
    //Route::delete('/note/{note}', [NoteController::class, 'destroy'])->name('note.destroy');

    // OR

    // Note Routes
    Route::resource('note', NoteController::class);

    // Home Routes
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home/about', [HomeController::class, 'about'])->name('home.about');

    // Analytics Routes
    Route::get('/analytics', [AnalyticsController::class, 'showData'])->name('analytics.index');
    Route::get('/analytics/send', [AnalyticsController::class, 'send'])->name('analytics.send');
    Route::get('/analytics/dashboard', [AnalyticsController::class, 'display'])->name('analytics.display');
    Route::post('/analytics/store', [AnalyticsController::class, 'storeRandomData'])->name('analytics.store');

    // MQTT Routes
    Route::get('/subscribe-mqtt', [MQTTController::class, 'subscribeToMqtt']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
