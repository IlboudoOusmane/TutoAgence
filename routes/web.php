<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController as ControllersPropertyController;
use Illuminate\Support\Facades\Route;


$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [ControllersPropertyController ::class, 'index'])->name('property.index');
Route::get('/biens/{slug}-{property}', [ControllersPropertyController ::class, 'show'])->name('property.show')->middleware('auth')->where([
  'property' => $idRegex,
  'slug' => $slugRegex
]);

Route::post('/bien/{property}/contact', [ControllersPropertyController::class, 'contact'])->name('property.contact')->where([
  'property' => $idRegex,
]);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);
});
