<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ChickenProductionController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ChickenPriceCatalogController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

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

        Route::get('/profile', function () {
            return view('admin.profile');
        })->name('profile');

        Route::resource('farmers', FarmerController::class);
        Route::resource('vehicles', VehicleController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('drivers', DriverController::class);
        Route::resource('chicken-productions', ChickenProductionController::class);
        Route::get('stock', [StockController::class, 'index'])->name('stock.index');
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('chicken-price-catalogs', ChickenPriceCatalogController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('dashboard', function () {
            return view('customer.dashboard');
        })->name('dashboard');

        Route::get('/profile', function () {
            return view('customer.profile');
        })->name('profile');

        Route::get('orders', [CustomerOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/create', [CustomerOrderController::class, 'create'])->name('orders.create');
        Route::post('orders', [CustomerOrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');
    });

Route::middleware(['auth', 'role:driver'])
    ->prefix('driver')
    ->name('driver.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('driver.dashboard');
        })->name('dashboard');

        Route::get('/profile', function () {
            return view('driver.profile');
        })->name('profile');
    });

Route::middleware(['auth', 'role:direktur'])
    ->prefix('direktur')
    ->name('direktur.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('direktur.dashboard');
        })->name('dashboard');

        Route::get('/profile', function () {
            return view('direktur.profile');
        })->name('profile');
    });

Route::get('/locations/cities/{city}/districts', [LocationController::class, 'getDistricts'])
    ->name('locations.districts');


require __DIR__.'/auth.php';