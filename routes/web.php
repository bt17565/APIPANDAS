<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\BundlerController;

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
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('dashboard', [BundlerController::class, 'dashboard'])->name('dashboard');
    Route::resource('bundlers', BundlerController::class);
    Route::post('execute-api-1', [BundlerController::class, 'executeApi1'])
        ->name('api1.execute');
    Route::post('execute-api-2', [BundlerController::class, 'executeApi2'])
        ->name('api2.execute');
    Route::post('execute-current-bundler', [BundlerController::class, 'executeCurrentBundler'])
        ->name('execute.bundler.current');
    Route::get('bundlers/{id}/execute', [BundlerController::class, 'executeBundler'])
        ->name('bundlers.execute');
    Route::post('search-data', [BundlerController::class, 'searchData'])
        ->name('search.data');
});
