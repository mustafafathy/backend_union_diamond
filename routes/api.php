<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WebsiteDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('projects', [ProjectController::class, 'index']);
Route::get('project/{id}', [ProjectController::class, 'project']);
Route::get('project_images', [ProjectController::class, 'project_images']);
Route::get('project_stages', [ProjectController::class, 'project_stages']);
Route::get('website-data', [WebsiteDataController::class, 'index']);
Route::get('map-info', [WebsiteDataController::class, 'map_info']);
Route::get('slider', [WebsiteDataController::class, 'slider']);
Route::get('logos', [WebsiteDataController::class, 'logos']);
Route::post('contact', [ContactController::class, 'create']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
