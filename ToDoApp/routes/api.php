<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
});

Route::resource('task', TaskController::class)->only(['index','store','update','destroy','show']);