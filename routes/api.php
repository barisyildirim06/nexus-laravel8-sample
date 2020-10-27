<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("partners",[PartnerController::class, 'partners']);

Route::get("partners/{id}", [PartnerController::class, 'partnersbyid']);

Route::post("partners", [PartnerController::class, 'add']);

Route::patch("partners/{id}",[PartnerController::class, 'update']);

Route::delete("partners/{id}", [PartnerController::class, 'deletepartner']);







