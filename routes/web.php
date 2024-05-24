<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;


Route::redirect('/', '/note')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function() {

    //Route::get('/note', [NoteController::class, 'index'])->name('note.index');
    //Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    //Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    //Route::get('/note/{note}', [NoteController::class, 'show'])->name('note.show');
    //Route::get('/note/{note}/edit', [NoteController::class, 'edit'])->name('note.edit');
    //Route::put('/note/{note}', [NoteController::class, 'update'])->name('note.update');
    //Route::delete('/note/{note}', [NoteController::class, 'destroy'])->name('note.destroy');

    // OR

    Route::resource('note', NoteController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
