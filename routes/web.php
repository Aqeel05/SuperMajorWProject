<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountDatatableController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;

// Public routes
Route::redirect('/', '/home')->name('dashboard');
// Home routes
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');

// To enter this middleware section, user must be authenticated and verified
Route::middleware(['auth', 'verified'])->group(function() {
    // Account datatable (staff only) routes
    Route::resource('accountData', AccountDatatableController::class);

    // Analytics routes
    Route::get('/analytics', [AnalyticsController::class, 'showData'])->name('analytics.index');
    Route::get('/analytics/sending', [AnalyticsController::class, 'mqttSend'])->name('analytics.sending');
    Route::get('/analytics/send', [AnalyticsController::class, 'send'])->name('analytics.send');
    Route::post('/analytics/store', [AnalyticsController::class, 'storeData'])->name('analytics.store');

    // Booking routes
    Route::resource('bookings', BookingsController::class);

    // MQTT subscription/unsubscription routes
    Route::post('/save-mqtt-message', [MqttController::class, 'saveMessage']);

    // Note routes
    Route::resource('note', NoteController::class);

    // Pressure session history routes
    Route::get('/history', [HistoryController::class, 'display'])->name('history.index');

    // Session controller routes
    Route::post('/start-session', [SessionController::class, 'startSession']);
    Route::post('/stop-session', [SessionController::class, 'stopSession']);

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::resource('sessions', SessionController::class)->except(['create', 'edit']);

});

// To enter this middleware section, user must be authenticated
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
