<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
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

Route::get('/', function () {
    return view('dashboard');
});

// Route::get('/news/add', [NewsController::class, 'add']);
// Route::get('/news', [NewsController::class, 'view']);
// Route::post('/news/add',[NewsController::class,'create']);
Route::prefix('/news')->group(
    function () {
        Route::get('/', [NewsController::class, 'view']);
        Route::get('/add', [NewsController::class, 'add']);
        Route::post('/add', [NewsController::class, 'create']);
        Route::get('/destroy/{id}', [NewsController::class, 'destroy']);
        Route::get('/toggle/{id}',[NewsController::class,'toggle']);
    }
);
