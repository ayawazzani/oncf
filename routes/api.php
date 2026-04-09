<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VoyageApiController;

Route::get('/voyages/search', [VoyageApiController::class, 'search']);