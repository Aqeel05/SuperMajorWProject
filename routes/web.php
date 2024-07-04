<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountDatatableController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::redirect('/', '/home')->name('dashboard');

// Home Routes
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/about', [HomeController::class, 'about'])->name('home.about');

// To enter this middleware section, user must be authenticated and verified
Route::middleware(['auth', 'verified'])->group(function() {
    // Account Datatable (staff only) Routes
    Route::resource('accountData', AccountDatatableController::class);

    // Analytics Routes
    Route::get('/analytics', [AnalyticsController::class, 'showData'])->name('analytics.index');
    Route::get('/analytics/send', [AnalyticsController::class, 'send'])->name('analytics.send');
    Route::get('/analytics/dashboard', [AnalyticsController::class, 'display'])->name('analytics.display');
    Route::post('/analytics/store', [AnalyticsController::class, 'storeData'])->name('analytics.store');

    // Chatbot (AI Physiology Assistant?) Routes
    Route::resource('chatbot', ChatbotController::class);

    // Note Routes
    Route::resource('note', NoteController::class);

    // MQTT Subscription/Unsubscription Routes
    //Route::post('/analytics/subscribe', [MqttController::class, 'subscribeToMqtt'])->name('mqtt.subscribe');
    //Route::post('/analytics/unsubscribe', [MqttController::class, 'unsubscribeToMqtt'])->name('mqtt.unsubscribe');

    //Route::get('/subscribe', [MqttController::class, 'subscribeToTopic']);
    //Route::get('/unsubscribe', [MqttController::class, 'unsubscribeFromTopic']);


});

// To enter this middleware section, user must be authenticated
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
