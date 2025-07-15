<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdController;

Route::get('/ads', [AdController::class, 'index']);
