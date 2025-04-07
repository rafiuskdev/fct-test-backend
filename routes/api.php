<?php

use Illuminate\Support\Facades\Route;
use Core\Infra\Http\Controller\VideoController;

Route::get('/videos', [VideoController::class, 'search']);
Route::get('/videos/{id}', [VideoController::class, 'searchById']);

