<?php

use Illuminate\Http\Request;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Models\Season;
use App\Mail\SeriesCreated;
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



/*Route::get('/series', [SeriesController::class, 'index' ])->name('series.index');

Route::get('/series/criar', [SeriesController::class, 'create' ]);

Route::post('/series/salvar', [SeriesController::class, 'store' ])->name('series.store');;

Route::delete('/series/delete/{serie}', [SeriesController::class, 'destroy' ])->name('series.delete');

Route::get('/series/edit/{serie}', [SeriesController::class, 'edit' ])->name('series.edit');

Route::post('/series/update{serie}', [SeriesController::class, 'update' ])->name('series.update');*/


Route::get('/', function () {
    return redirect('/series');
})->middleware(\App\Http\Middleware\Autenticador::class);



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/register', [UsersController::class, 'create'])->name('users.create');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('autenticador')->group(function () {


    Route::resource('/series', SeriesController::class)
        ->except(['show']);

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');


    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');

    Route::get('/email', function () {
        return new \App\Mail\SeriesCreated(
            'Green',
            11,
            5,
            8,
        );
    });


});
