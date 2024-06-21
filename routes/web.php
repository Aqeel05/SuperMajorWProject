<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\HomeController;

// Public Routes
Route::redirect('/', '/home')->name('dashboard');
//      {Home Routes}
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/about', [HomeController::class, 'about'])->name('home.about');

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

    // Analytics Routes
    Route::get('/analytics', [AnalyticsController::class, 'showData'])->name('analytics.index');
    Route::get('/analytics/send', [AnalyticsController::class, 'send'])->name('analytics.send');
    Route::get('/analytics/dashboard', [AnalyticsController::class, 'display'])->name('analytics.display');
    Route::post('/analytics/store', [AnalyticsController::class, 'storeData'])->name('analytics.store');

    // MQTT Subscription/Unsubscription Routes
    //Route::post('/analytics/subscribe', [MqttController::class, 'subscribeToMqtt'])->name('mqtt.subscribe');
    //Route::post('/analytics/unsubscribe', [MqttController::class, 'unsubscribeToMqtt'])->name('mqtt.unsubscribe');

    //Route::get('/subscribe', [MqttController::class, 'subscribeToTopic']);
    //Route::get('/unsubscribe', [MqttController::class, 'unsubscribeFromTopic']);


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
