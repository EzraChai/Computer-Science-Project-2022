<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HakimController;
use App\Http\Controllers\PertandinganController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SearchController;
use App\Models\Peserta;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'home']);

Route::get("/stream/video",[Controller::class, 'homeVideo']);

Route::get('/competitions', [PertandinganController::class, 'competition']);

Route::get("/competitions/query", [SearchController::class, 'query']);

Route::get('/competitions/{id}', [PertandinganController::class, 'competitionWithId']);


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');

    Route::get('/user', [Controller::class, 'user'])->name('user');

    Route::post('/user/search',[Controller::class,'userQuery']);

    Route::delete('/user/{id}', [Controller::class, 'drop']);

    Route::post('/user/{id}/admin', [Controller::class, 'changeStatus']);

    Route::get('/user/create', [Controller::class, 'showUserRegister']);


    Route::get('/dashboard/competition', [PertandinganController::class, 'index']);

    Route::post('/user/register', [Controller::class, 'userRegister']);

    Route::resource('/dashboard/competition', PertandinganController::class);

    Route::get('/dashboard/competition/{competition_id}/participant/import', [PesertaController::class, 'showParticipantImport']);

    Route::post('/dashboard/competition/{competition_id}/participant/import', [PesertaController::class, 'storeParticipantImport']);

    Route::resource('/dashboard/competition/{competition_id}/participant', PesertaController::class)->except('index');

    Route::get('/dashboard/competition/{competition_id}/participant', [PesertaController::class, 'indexWithCompetitionId']);

    Route::post('/dashboard/competition/{competition_id}/participant/{participant_id}/add-marks', [HakimController::class, 'addMarks']);

    Route::post('/dashboard/competition/{competition_id}/participant/{participant_id}/change-marks', [HakimController::class, 'changeMarks']);
});
