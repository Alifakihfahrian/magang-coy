<?php
    use App\Http\Controllers\BarangApi;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\StokApiController;
    use App\Http\Controllers\AuthController;

    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
   
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/barang', [BarangApi::class, 'index']);
        Route::post('/barang', [BarangApi::class, 'store']);
        Route::get('/barang/{id}', [BarangApi::class, 'show']);
        Route::post('/barang/{id}', [BarangApi::class, 'update']);
        Route::delete('/barang/{id}', [BarangApi::class, 'destroy']);
        Route::put('/stok/{id}', [StokApiController::class, 'update']);
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/project', function () {
            return 'Projects Fetch Successfully!';
        });
    });