<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->error('Route not found', Response::HTTP_NOT_FOUND);
});
