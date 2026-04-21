<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ChickenProductionController;
use App\Http\Controllers\Admin\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }

        if ($user->hasRole('driver')) {
            return redirect()->route('driver.dashboard');
        }

        if ($user->hasRole('direktur')) {
            return redirect()->route('direktur.dashboard');
        }

        abort(403, 'Role belum ditentukan.');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('farmers', FarmerController::class);
        Route::resource('vehicles', VehicleController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('drivers', DriverController::class);
        Route::resource('chicken-productions', ChickenProductionController::class);
        Route::get('stock', [StockController::class, 'index'])->name('stock.index');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';