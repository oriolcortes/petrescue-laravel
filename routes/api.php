<?php

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

// Ruta por defecto con la creación del proyecto de Laravel. Retorna el usuario autenticado con Sanctum.
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Ruta de verificación de estado. Retorna el estado de la app y la conexión a la BD.
Route::get('/health', function () {
    $dbStatus = 'ok';

    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
    } catch (\Exception $e) {
        $dbStatus = 'error: ' . $e->getMessage();
    }

    return response()->json([
        'status' => 'ok',
        'app' => config('app.name'),
        'time' => now()->toIso8601String(),
        'database' => $dbStatus,
    ]);
});
