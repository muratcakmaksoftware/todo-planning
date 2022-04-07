<?php

use App\Http\Controllers\Backend\Tasks\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tasks'], function () {
    Route::get("/", [TaskController::class, 'index'])->name('tasks.index');
});
