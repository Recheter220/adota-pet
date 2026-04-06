<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::prefix('/pets')
    ->group(function () {
        Route::get('/', '\App\Http\Controllers\PetController@index')->name('pets.index');
        // Route::get('/{id}', '\App\Http\Controllers\PetController@show')->name('pets.show');
        Route::get('/new', '\App\Http\Controllers\PetController@create')->name('pets.create');
        Route::get('/{pet}/edit', '\App\Http\Controllers\PetController@edit')->name('pets.edit');
        Route::post('/', '\App\Http\Controllers\PetController@store')->name('pets.store');
        Route::patch('/{pet}', '\App\Http\Controllers\PetController@update')->name('pets.update');
        Route::delete('/{pet}', '\App\Http\Controllers\PetController@destroy')->name('pets.delete');
    });

Route::prefix('/organizations')
    ->group(function () {
        Route::get('/', '\App\Http\Controllers\OrganizationController@index')->name('organizations.index');
        Route::get('/{organization:slug}', '\App\Http\Controllers\OrganizationController@show')->name('organizations.show');
        Route::get('/new', '\App\Http\Controllers\OrganizationController@create')->name('organizations.create');
        Route::get('/{id}/edit', '\App\Http\Controllers\OrganizationController@edit')->name('organizations.edit');
        Route::post('/', '\App\Http\Controllers\OrganizationController@store')->name('organizations.store');
        Route::patch('/{id}', '\App\Http\Controllers\OrganizationController@update')->name('organizations.update');
        Route::delete('/{id}', '\App\Http\Controllers\OrganizationController@destroy')->name('organizations.delete');
    });
