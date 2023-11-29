<?php

use Illuminate\Support\Facades\Route;
use Mostafaznv\NovaCkEditor\Http\Controllers\Api\UploadImageController;
use Mostafaznv\NovaCkEditor\Http\Controllers\Api\ApiController;


Route::as('nova-ckeditor.')->middleware('nova')->group(function () {
    Route::prefix('image')->name('image.')->group(function () {
        Route::post('/', UploadImageController::class)->name('upload');
    });

    Route::get('variaveis/{term}', [ApiController::class, 'searchVariaveis'])->name('variaveis.search');
    Route::get('formulas/{term}', [ApiController::class, 'searchFormulas'])->name('formulas.search');
});
