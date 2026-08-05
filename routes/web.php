<?php

declare(strict_types=1);

use App\Http\Controllers\CiteController;
use App\Http\Controllers\CmpController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\ServiceOrderSignatoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEmailResetNotificationController;
use App\Http\Controllers\UserEmailVerificationController;
use App\Http\Controllers\UserEmailVerificationNotificationController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('welcome'))->name('home');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('dashboard', fn () => Inertia::render('dashboard'))->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function (): void {
    // Directions...
    Route::get('directions', [DirectionController::class, 'index'])->name('directions.index');
    Route::get('directions/create', [DirectionController::class, 'create'])->name('directions.create');
    Route::post('directions', [DirectionController::class, 'store'])->name('directions.store');
    Route::get('directions/{direction}', [DirectionController::class, 'show'])->name('directions.show');
    Route::get('directions/{direction}/edit', [DirectionController::class, 'edit'])->name('directions.edit');
    Route::patch('directions/{direction}', [DirectionController::class, 'update'])->name('directions.update');
    Route::delete('directions/{direction}', [DirectionController::class, 'destroy'])->name('directions.destroy');

    // Cmps (nested under direction)...
    Route::get('directions/{direction}/cmps', [CmpController::class, 'index'])->name('directions.cmps.index');
    Route::get('directions/{direction}/cmps/create', [CmpController::class, 'create'])->name('directions.cmps.create');
    Route::post('directions/{direction}/cmps', [CmpController::class, 'store'])->name('directions.cmps.store');
    Route::get('directions/{direction}/cmps/{cmp}', [CmpController::class, 'show'])->name('directions.cmps.show');
    Route::get('directions/{direction}/cmps/{cmp}/edit', [CmpController::class, 'edit'])->name('directions.cmps.edit');
    Route::patch('directions/{direction}/cmps/{cmp}', [CmpController::class, 'update'])->name('directions.cmps.update');
    Route::delete('directions/{direction}/cmps/{cmp}', [CmpController::class, 'destroy'])->name('directions.cmps.destroy');

    // Contracts (nested under cmp)...
    Route::get('directions/{direction}/cmps/{cmp}/contracts', [ContractController::class, 'index'])->name('cmps.contracts.index');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/create', [ContractController::class, 'create'])->name('cmps.contracts.create');
    Route::post('directions/{direction}/cmps/{cmp}/contracts', [ContractController::class, 'store'])->name('cmps.contracts.store');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}', [ContractController::class, 'show'])->name('cmps.contracts.show');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('cmps.contracts.edit');
    Route::patch('directions/{direction}/cmps/{cmp}/contracts/{contract}', [ContractController::class, 'update'])->name('cmps.contracts.update');
    Route::delete('directions/{direction}/cmps/{cmp}/contracts/{contract}', [ContractController::class, 'destroy'])->name('cmps.contracts.destroy');

    // Service Orders (nested under contract)...
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders', [ServiceOrderController::class, 'index'])->name('contracts.service-orders.index');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/create', [ServiceOrderController::class, 'create'])->name('contracts.service-orders.create');
    Route::post('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders', [ServiceOrderController::class, 'store'])->name('contracts.service-orders.store');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}', [ServiceOrderController::class, 'show'])->name('contracts.service-orders.show');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/edit', [ServiceOrderController::class, 'edit'])->name('contracts.service-orders.edit');
    Route::patch('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}', [ServiceOrderController::class, 'update'])->name('contracts.service-orders.update');
    Route::delete('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}', [ServiceOrderController::class, 'destroy'])->name('contracts.service-orders.destroy');

    // Zones...
    Route::get('zones', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('zones/create', [ZoneController::class, 'create'])->name('zones.create');
    Route::post('zones', [ZoneController::class, 'store'])->name('zones.store');
    Route::get('zones/{zone}', [ZoneController::class, 'show'])->name('zones.show');
    Route::get('zones/{zone}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
    Route::patch('zones/{zone}', [ZoneController::class, 'update'])->name('zones.update');
    Route::delete('zones/{zone}', [ZoneController::class, 'destroy'])->name('zones.destroy');

    // Sros (nested under zone)...
    Route::get('zones/{zone}/sros', [SroController::class, 'index'])->name('zones.sros.index');
    Route::get('zones/{zone}/sros/create', [SroController::class, 'create'])->name('zones.sros.create');
    Route::post('zones/{zone}/sros', [SroController::class, 'store'])->name('zones.sros.store');
    Route::get('zones/{zone}/sros/{sro}', [SroController::class, 'show'])->name('zones.sros.show');
    Route::get('zones/{zone}/sros/{sro}/edit', [SroController::class, 'edit'])->name('zones.sros.edit');
    Route::patch('zones/{zone}/sros/{sro}', [SroController::class, 'update'])->name('zones.sros.update');
    Route::delete('zones/{zone}/sros/{sro}', [SroController::class, 'destroy'])->name('zones.sros.destroy');

    // Cites (nested under sro)...
    Route::get('zones/{zone}/sros/{sro}/cites', [CiteController::class, 'index'])->name('sros.cites.index');
    Route::get('zones/{zone}/sros/{sro}/cites/create', [CiteController::class, 'create'])->name('sros.cites.create');
    Route::post('zones/{zone}/sros/{sro}/cites', [CiteController::class, 'store'])->name('sros.cites.store');
    Route::get('zones/{zone}/sros/{sro}/cites/{cite}', [CiteController::class, 'show'])->name('sros.cites.show');
    Route::get('zones/{zone}/sros/{sro}/cites/{cite}/edit', [CiteController::class, 'edit'])->name('sros.cites.edit');
    Route::patch('zones/{zone}/sros/{sro}/cites/{cite}', [CiteController::class, 'update'])->name('sros.cites.update');
    Route::delete('zones/{zone}/sros/{sro}/cites/{cite}', [CiteController::class, 'destroy'])->name('sros.cites.destroy');

    // Service Order Signatories (nested under service order)...
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories', [ServiceOrderSignatoryController::class, 'index'])->name('service-orders.signatories.index');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories/create', [ServiceOrderSignatoryController::class, 'create'])->name('service-orders.signatories.create');
    Route::post('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories', [ServiceOrderSignatoryController::class, 'store'])->name('service-orders.signatories.store');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories/{signatory}', [ServiceOrderSignatoryController::class, 'show'])->name('service-orders.signatories.show');
    Route::get('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories/{signatory}/edit', [ServiceOrderSignatoryController::class, 'edit'])->name('service-orders.signatories.edit');
    Route::patch('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories/{signatory}', [ServiceOrderSignatoryController::class, 'update'])->name('service-orders.signatories.update');
    Route::delete('directions/{direction}/cmps/{cmp}/contracts/{contract}/service-orders/{serviceOrder}/signatories/{signatory}', [ServiceOrderSignatoryController::class, 'destroy'])->name('service-orders.signatories.destroy');
});

Route::middleware('auth')->group(function (): void {
    // User...
    Route::delete('user', [UserController::class, 'destroy'])->name('user.destroy');

    // User Profile...
    Route::redirect('settings', '/settings/profile');
    Route::get('settings/profile', [UserProfileController::class, 'edit'])->name('user-profile.edit');
    Route::patch('settings/profile', [UserProfileController::class, 'update'])->name('user-profile.update');

    // User Password...
    Route::get('settings/password', [UserPasswordController::class, 'edit'])->name('password.edit');
    Route::put('settings/password', [UserPasswordController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('password.update');

    // Appearance...
    Route::get('settings/appearance', fn () => Inertia::render('appearance/update'))->name('appearance.edit');

});

Route::middleware('guest')->group(function (): void {
    // User...
    Route::get('register', [UserController::class, 'create'])
        ->name('register');
    Route::post('register', [UserController::class, 'store'])
        ->name('register.store');

    // User Password...
    Route::get('reset-password/{token}', [UserPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [UserPasswordController::class, 'store'])
        ->name('password.store');

    // User Email Reset Notification...
    Route::get('forgot-password', [UserEmailResetNotificationController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [UserEmailResetNotificationController::class, 'store'])
        ->name('password.email');

    // Session...
    Route::get('login', [SessionController::class, 'create'])
        ->name('login');
    Route::post('login', [SessionController::class, 'store'])
        ->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    // User Email Verification...
    Route::get('verify-email', [UserEmailVerificationNotificationController::class, 'create'])
        ->name('verification.notice');
    Route::post('email/verification-notification', [UserEmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // User Email Verification...
    Route::get('verify-email/{id}/{hash}', [UserEmailVerificationController::class, 'update'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Session...
    Route::post('logout', [SessionController::class, 'destroy'])
        ->name('logout');
});
