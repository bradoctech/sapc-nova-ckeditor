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

    Route::prefix('certidoes')->group(function () {
        Route::get('/rreo-anexos', [ApiController::class, 'listRREOAnexos'])->name('siconfi_rreo.anexo');
        Route::get('/rreo-contas/anexo/{anexo}', [ApiController::class, 'listRREOContasByAnexo'])->name('siconfi_rreo.anexo_conta');
        Route::get('/rreo-colunas/anexo/{anexo}/conta/{conta}', [ApiController::class, 'listRREOColunasByAnexoAndConta'])->name('siconfi_rreo.anexo_conta_coluna');
    });
});
