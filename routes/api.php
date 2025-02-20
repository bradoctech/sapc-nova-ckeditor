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
        Route::get('/rreo-anexos/{term}', [ApiController::class, 'listRREOAnexos'])->name('siconfi_rreo.anexo');
        Route::get('/rreo-contas/anexo/{anexo}/{term}', [ApiController::class, 'listRREOContasByAnexo'])->name('siconfi_rreo.anexo_conta');
        Route::get('/rreo-colunas/anexo/{anexo}/conta/{conta}/{term}', [ApiController::class, 'listRREOColunasByAnexoAndConta'])->name('siconfi_rreo.anexo_conta_coluna');
        
        Route::get('/rgf-anexos/{term}', [ApiController::class, 'listRGFAnexos'])->name('siconfi_rgf.anexo');
        Route::get('/rgf-contas/anexo/{anexo}/{term}', [ApiController::class, 'listRGFContasByAnexo'])->name('siconfi_rgf.anexo_conta');
        Route::get('/rgf-colunas/anexo/{anexo}/conta/{conta}/{term}', [ApiController::class, 'listRGFColunasByAnexoAndConta'])->name('siconfi_rgf.anexo_conta_coluna');
    });
});
