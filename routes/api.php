<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpecialisationController;
use App\Http\Controllers\Api\ProfessionalProfileController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserMessageController;
use App\Http\Controllers\Api\RatingController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/profiles', [ProfessionalProfileController::class, 'index']);
Route::get('/profiles/profile-sponsored', [ProfessionalProfileController::class, 'profileSponsored']);
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviewscount', [ReviewController::class, 'countReviews']);
Route::get('/reviewspecfilter', [ReviewController::class, 'filterBySpecAndRating']);
Route::get('profiles/{slug}', [ProfessionalProfileController::class, 'show']);
Route::get('/specialisations', [SpecialisationController::class, 'index']);
Route::get('/specialisations/{slug}', [ProfessionalProfileController::class, 'showBySpec']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::post('/messages', [UserMessageController::class, 'store']);
Route::post('/ratings', [RatingController::class, 'store']);
Route::get('/search-results', [ReviewController::class, 'filterProfiles']);
Route::get('/sponsored', [ProfessionalProfileController::class, 'sponsoredDoctors']);





// 