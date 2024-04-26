<?php

use App\Http\Controllers\PublicAPIController;
use App\Http\Controllers\ClientAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Post\PostRepositoryInterface;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('posts', function (Request $request, PostRepositoryInterface $postRepository) {
        $posts = $postRepository->getPostHost();
        return response()->json($posts);
    });

    Route::prefix('public')->group(function () {
        Route::get('provinces', [PublicAPIController::class, 'getProvinces'])->name('api.public.provices');
        Route::get('districts/{provincecode}', [PublicAPIController::class, 'getDistricts'])->where('provincecode', '[0-9]+')->name('api.public.districts');
        Route::get('wards/{districtcode}', [PublicAPIController::class, 'getWards'])->where('districtcode', '[0-9]+')->name('api.public.wards');
    });

    Route::prefix('client')->group(function () {
        Route::middleware(['auth:sanctum', 'abilities:' . config('constants.user.access.client')])->group(function () {
            Route::get('/', [ClientAPIController::class, 'index'])->name('api.client.index');
            Route::put('/', [ClientAPIController::class, 'update'])->name('api.client.update');
            Route::post('/password', [ClientAPIController::class, 'updatePassword'])->name('api.client.updatepassword');
            Route::post('/logout', [ClientAPIController::class, 'logout'])->name('api.client.logout');
            Route::get('/relations', [ClientAPIController::class, 'getRelations'])->name('api.client.relations');
        });
        Route::post('/', [ClientAPIController::class, 'store'])->name('api.client.create');
        Route::post('/authentication', [ClientAPIController::class, 'login'])->name('api.client.authen');
    });

    Route::get('test', function () {
        return 'ok';
    });
});
