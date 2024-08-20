<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountDatatableController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MQTTController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;

// Public routes
Route::redirect('/', '/home')->name('dashboard');
// Home routes
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');

Route::get('/history/session', [HistoryController::class, 'session'])->name('history.session');

// To enter this middleware section, user must be authenticated and verified
Route::middleware(['auth', 'verified'])->group(function() {
    // Account datatable (staff only) routes
    Route::resource('accountData', AccountDatatableController::class);

    // Analytics routes
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/analytics/sending', [AnalyticsController::class, 'mqttSend'])->name('analytics.sending');
    Route::get('/analytics/send', [AnalyticsController::class, 'send'])->name('analytics.send');

    // Booking routes
    Route::resource('bookings', BookingsController::class);

    // MQTT subscription/unsubscription routes
    Route::post('/save-mqtt-message', [MQTTController::class, 'saveMessage'])->name('mqtt.saveMessage');


    // Note routes
    Route::resource('note', NoteController::class);

    // Pressure session history routes
    //Route::get('/pressureSessions', [PressureSessionController::class, 'index'])->name('pressureSessions.index');
    //Route::get('/pressureSessions/{id}', [PressureSessionController::class, 'show'])->name('pressureSessions.show');
    
    // Session controller Routes
    Route::resource('history', HistoryController::class)->except(['create', 'edit']);
    Route::get('/get-latest-session-id', [SessionController::class, 'getLatestSessionId']);
    Route::post('/save-capture', [SessionController::class, 'saveCapture']);


    // Route to show a specific session
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

    // Route to start a session
    Route::post('/start-session', [SessionController::class, 'startSession'])->name('start-session');

    // Route to stop a session
    Route::post('/stop-session', [SessionController::class, 'stopSession'])->name('stop-session');

    // Route to capture a timestamp during a session
    Route::post('/capture-timestamp', [SessionController::class, 'captureTimestamp'])->name('capture-timestamp');

    // Route to save MQTT message
    Route::post('/save-mqtt-message', [MQTTController::class, 'saveMessage'])->name('save-mqtt-message');

    Route::get('/get-influxdb-data', [MQTTController::class, 'getInfluxDBData'])->name('get-influxdb-data');

    // Route to delete a session
    Route::delete('/history/{id}', [SessionController::class, 'destroy'])->name('history.destroy');



});

// To enter this middleware section, user must be authenticated
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
