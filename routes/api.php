<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpecialisationController;
use App\Http\Controllers\Api\ProfessionalProfileController;

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
Route::get('profiles/{slug}', [ProfessionalProfileController::class, 'show']);
Route::get('/specialisations', [SpecialisationController::class, 'index']);
// Route::post('/messages', MessageController::class, 'store');
