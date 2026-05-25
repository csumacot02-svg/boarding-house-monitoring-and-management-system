<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('tenant.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/tenant/dashboard', [TenantController::class, 'dashboard'])
        ->name('tenant.dashboard');

    Route::resource('rooms', RoomController::class);
    Route::resource('billings', BillingController::class);
    Route::resource('maintenance', MaintenanceRequestController::class);
    Route::resource('announcements', AnnouncementController::class);

    Route::get('/admin/gcash-settings', [PaymentSettingController::class, 'edit'])
        ->name('admin.gcash.edit');

    Route::put('/admin/gcash-settings', [PaymentSettingController::class, 'update'])
        ->name('admin.gcash.update');

    Route::get('/admin/gcash-payments', [BillingController::class, 'gcashPayments'])
        ->name('admin.gcash.payments');

    Route::put('/admin/gcash-payments/{billing}/verify', [BillingController::class, 'verifyGcashPayment'])
        ->name('admin.gcash.verify');

    Route::post('/tenant/billings/{billing}/upload-receipt', [BillingController::class, 'uploadReceipt'])
        ->name('tenant.billings.upload-receipt');

    Route::post('/billings/{billing}/upload-receipt', [BillingController::class, 'uploadReceipt'])
        ->name('billings.upload-receipt');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';