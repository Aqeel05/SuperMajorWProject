<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountDatatableController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\NoteController;

// Public Routes
Route::redirect('/', '/home')->name('dashboard');
// {Home Routes}
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

    // Account Datatable (staff only) Routes
    Route::resource('accountData', AccountDatatableController::class);

    // History Routes
    Route::get('/history', [HistoryController::class, 'display'])->name('history.index');

    // Analytics Routes
    Route::get('/analytics', [AnalyticsController::class, 'showData'])->name('analytics.index');
    Route::get('/analytics/sending', [AnalyticsController::class, 'mqttSend'])->name('analytics.sending');
    Route::get('/analytics/send', [AnalyticsController::class, 'send'])->name('analytics.send');
    Route::post('/analytics/store', [AnalyticsController::class, 'storeData'])->name('analytics.store');

    // MQTT Subscription/Unsubscription Routes
    Route::post('/save-mqtt-message', [MqttController::class, 'saveMessage']);

    // Bookings routes
    Route::resource('bookings', BookingsController::class);

    // Session controller Routes
    Route::post('/start-session', [SessionController::class, 'startSession']);
    Route::post('/stop-session', [SessionController::class, 'stopSession']);


    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::resource('sessions', SessionController::class)->except(['create', 'edit']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
