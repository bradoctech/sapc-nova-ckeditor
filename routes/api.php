<?php

use Illuminate\Support\Facades\Route;
use Bradoctech\SapcNovaCkEditor\Http\Controllers\Api\UploadImageController;
use Bradoctech\SapcNovaCkEditor\Http\Controllers\Api\ApiController;


Route::as('nova-ckeditor.')->middleware('nova')->group(function () {
    Route::prefix('image')->name('image.')->group(function () {
        Route::post('/', UploadImageController::class)->name('upload');
    });

    Route::get('variaveis/{term}', [ApiController::class, 'searchVariaveis'])->name('variaveis.search');
    Route::get('formulas/{term}', [ApiController::class, 'searchFormulas'])->name('formulas.search');
    Route::get('variaveisContaGoverno/{term}', [ApiController::class, 'searchVariaveisContaGoverno'])->name('variaveis-conta-governo.search');
});
