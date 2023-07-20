<?php

use App\Http\Controllers\Api\SupportApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/supports', SupportApiController::class);