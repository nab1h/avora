<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');


Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::put('/profile/update-data', [ProfileController::class, 'updateData'])->name('profile.update.data');

    // admin
        Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {




        });

        Route::prefix('themes')->name('themes.')->group(function () {




        });

    });

    // admin + sales
    Route::middleware('role:admin,sales')->group(function () {
            Route::get('/reservations', [ReservationController::class, 'index'])
                ->name('reservations.index');

            Route::patch('/reservations/{id}/confirm', [ReservationController::class, 'confirmStatus'])
                ->name('reservations.confirm');

            Route::patch('/reservations/{id}/complete', [ReservationController::class, 'completeStatus'])
                ->name('reservations.complete');
            Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])
                ->name('reservations.destroy');

            Route::post('/reservations/{id}/archive-action', [ReservationController::class, 'moveToArchive'])
                ->name('reservations.moveToArchive');

            Route::get('/reservations/archive', [ReservationController::class, 'archive'])
                ->name('reservations.archive');

            Route::patch('/reservations/{id}/restore', [ReservationController::class, 'restore'])
                ->name('reservations.restore');


    });
    }
);

Route::get('/u/{theme_id}/{slug}', [ProfileController::class, 'show'])->name('profile.show');
require __DIR__.'/auth.php';
