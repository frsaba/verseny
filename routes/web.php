<?php

use App\Http\Controllers\RacesController;
use App\Http\Controllers\RoundsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function Termwind\render;

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
    return Inertia::render("Home");
});

Route::get('/races', [RacesController::class, 'index']);
Route::post('/races', [RacesController::class, 'create']);
Route::post('/races/{id}/rounds', [RoundsController::class, 'create']);