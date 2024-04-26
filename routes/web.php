<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('client')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::get('/view/{clientId}', [ClientController::class, 'view'])->name('client.view');
        Route::get('/add', [ClientController::class, 'add'])->name('client.add');
        Route::post('/add', [ClientController::class, 'store'])->name('client.store');
        Route::get('/edit/{clientId}', [ClientController::class, 'edit'])->name('client.edit');
        Route::put('/edit/{clientId}', [ClientController::class, 'update'])->name('client.update');
        Route::get('/setting', [ClientController::class, 'setting'])->name('client.setting');
    });

    Route::prefix('content')->group(function () {
        Route::get('/add', [ContentController::class, 'add'])->name('content.add');
        Route::post('/add', [ContentController::class, 'store'])->name('content.store');
    });
    Route::prefix('property')->group(function () {
        Route::get('/add', [PropertyController::class, 'add'])->name('property.add');
        Route::post('/add', [PropertyController::class, 'store'])->name('property.store');
        Route::get('/', [PropertyController::class, 'index'])->name('property.index');
    });


    Route::prefix('ajax')->group(function () {
        Route::get('referral/check', [AjaxController::class, 'checkReferral'])
            ->name('ajax.checkreferral')
            ->middleware('auth');
        Route::post('draft/file', [AjaxController::class, 'draftUpload'])
            ->name('ajax.draftupload')
            ->middleware('auth');
        Route::post('draft/delete', [AjaxController::class, 'deleteDraftFile'])
            ->name('ajax.deletefile')
            ->middleware('auth');
        Route::post('draft/retrieve',  [AjaxController::class, 'getDraftFile'])
            ->name('ajax.getfile')
            ->middleware('auth');;
    });
});

require __DIR__ . '/auth.php';
