<?php

use App\ProductionTable;
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

Route::get('/tables-by-floor/{floor}', function ($floorId) {
    return ProductionTable::where('floor_id', $floorId)
        ->withCount('users')
        ->get()
        ->map(function ($table) {
            return [
                'id' => $table->id,
                'full_name' => $table->full_name,
            ];
        });
});

