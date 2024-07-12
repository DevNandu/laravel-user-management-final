<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;



Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::get('/export-csv', [UserController::class, 'exportCsv'])->name('users.export-csv');
Route::resource('departments', DepartmentController::class)->except(['create', 'edit', 'show']);
Route::resource('designations', DesignationController::class)->except(['create', 'edit', 'show']);

Route::resource('departments', DepartmentController::class);
Route::resource('designations', DesignationController::class);
