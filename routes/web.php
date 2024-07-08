<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfessionalProfileController;
use App\Http\Controllers\Admin\SponsorshipController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // route per reviews
    Route::get('profiles/reviews', [ProfessionalProfileController::class, 'reviews'])->name('reviews');
    Route::resource('sponsorships', SponsorshipController::class);
    Route::resource('profiles', ProfessionalProfileController::class)->parameters([
        'profiles' => 'profile:user_slug'
    ]);
    // payments
    Route::get('payments/pacchetto-silver', [PaymentController::class, 'silver'])->name('payments.silver');
    Route::get('payments/pacchetto-gold', [PaymentController::class, 'gold'])->name('payments.gold');
    Route::get('payments/pacchetto-platinum', [PaymentController::class, 'platinum'])->name('payments.platinum');
    Route::post('payments/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
    Route::get('payments/success', [PaymentController::class, 'success'])->name('payments.success');
    Route::get('payments/error', [PaymentController::class, 'error'])->name('payments.error');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/admin/profiles/{profile}', [ProfessionalProfileController::class, 'update'])->name('admin.profiles.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
