<?php

use App\Http\Controllers\NotebookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/** Получение всех записных книжек */
Route::get('notebook', [NotebookController::class,'index']);

/** Добавление записной книжки */
Route::post('notebook', [NotebookController::class,'store']);

/** Получение записной книжки по id */
Route::get('notebook/{id}', [NotebookController::class,'show']);

/** Редактирование записной книжки по id */
Route::post('notebook/{id}', [NotebookController::class,'update']);

/** Удаление записной книжки по id */
Route::delete('notebook/{id}', [NotebookController::class,'delete']);


