<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\ThemeController;
use App\Http\Controllers\admin\PlatformController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', [HomeController::class, 'index'])->name('home');



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
        // ** Orders Controller **
            Route::delete('/orders/{id}/force-delete', [OrderController::class, 'forceDelete'])->name('orders.force-delete');
            Route::delete('/orders/delete-all', [OrderController::class, 'deleteAllOrder'])
            ->name('orders.deleteAllOrder');


    });

    // admin + sales
    Route::middleware('role:admin,sales')->group(function () {
        Route::get('/orders/archived', [OrderController::class, 'archived'])->name('orders.archived');
        Route::get('/orders/deleted', [OrderController::class, 'deleted'])->name('orders.deleted');
        Route::post('/orders/addorder', [OrderController::class, 'storeInUser'])->name('orders.storeInUser');
        Route::post('/orders/{id}/archive', [OrderController::class, 'archive'])->name('orders.archive');
        Route::post('/orders/{id}/unarchive', [OrderController::class, 'unarchive'])->name('orders.unarchive');
        Route::put('/orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
        Route::resource('orders', OrderController::class);
    });
    }
);

Route::get('/u/{theme_id}/{slug}', [ProfileController::class, 'show'])->name('profile.show');
require __DIR__.'/auth.php';
