<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::controller(PetController::class)
    ->prefix('/pets')
    ->group(function () {
        Route::get('/', 'index')->name('pets.index');
        Route::get('/new', 'create')->name('pets.create');
        Route::get('/{id}/edit', 'edit')->name('pets.edit');
        Route::post('/', 'store')->name('pets.store');
        Route::patch('/{id}', 'update')->name('pets.update');
    });

Route::post('/teste', function () {
    dd('POST teste');
});
