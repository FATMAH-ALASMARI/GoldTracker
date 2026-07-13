<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoldController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SystemHealthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [GoldController::class, 'index'])
    ->name('gold.index');

Route::get('/gold/export', [GoldController::class, 'export'])
    ->name('gold.export');


/*
|--------------------------------------------------------------------------
| Dashboard Compatibility Route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('gold.index');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/create', [GoldController::class, 'create'])
        ->name('gold.create');

    Route::post('/store', [GoldController::class, 'store'])
        ->name('gold.store');

    Route::get('/edit/{id}', [GoldController::class, 'edit'])
        ->name('gold.edit');

    Route::put('/update/{id}', [GoldController::class, 'update'])
        ->name('gold.update');

    Route::delete('/delete/{id}', [GoldController::class, 'destroy'])
        ->name('gold.destroy');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Users Management
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('admin.users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('admin.users.store');

        Route::put('/users/{user}/role', [UserController::class, 'role'])
            ->name('admin.users.role');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');


        /*
        |--------------------------------------------------------------------------
        | Activity Logs
        |--------------------------------------------------------------------------
        */

        Route::get('/logs', [AdminController::class, 'logs'])
            ->name('admin.logs');


        /*
        |--------------------------------------------------------------------------
        | System Health
        |--------------------------------------------------------------------------
        */

        Route::get('/system-health', [SystemHealthController::class, 'index'])
            ->name('admin.system-health');

        Route::post(
            '/system-health/update',
            [SystemHealthController::class, 'updateNow']
        )->name('admin.system-health.update');

    });


require __DIR__.'/auth.php';