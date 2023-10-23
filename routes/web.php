<?php

use App\Http\Controllers\ContestantsController;
use App\Http\Controllers\RacesController;
use App\Http\Controllers\RoundsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

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
	$users = ['users' => User::all()];

	return Inertia::render('Home', $users);
});

Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'create']);

Route::get('/races', [RacesController::class, 'index']);
Route::post('/races', [RacesController::class, 'create']);
Route::post('/races/{id}/rounds', [RoundsController::class, 'create']);
Route::post('/rounds/{id}/contestants', [ContestantsController::class, 'create']);