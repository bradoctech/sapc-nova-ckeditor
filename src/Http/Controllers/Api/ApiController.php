<?php

namespace Bradoctech\SapcNovaCkEditor\Http\Controllers\Api;

use App\Models\Sapc\Formula;
use App\Models\Sapc\VariavelContaGestao;
use App\Models\Sapc\VariavelContaGoverno;
use App\Models\SiconfiRGF;
use App\Models\SiconfiRREO;
use Illuminate\Routing\Controller;


class ApiController extends Controller
{
    public function searchVariaveis($term)
    {
        $listaVariavel = VariavelContaGestao::where('nome', 'LIKE', "%{$term}%")->get();
        return response()->json($listaVariavel);
    }

    public function searchFormulas($term)
    {
        $listaFormula = Formula::where('nome', 'LIKE', "%{$term}%")->get();
        return response()->json($listaFormula);
    }

    public function searchVariaveisContaGoverno($term)
    {
        $listaVariavel = VariavelContaGoverno::where('nome', 'LIKE', "%{$term}%")->get();
        return response()->json($listaVariavel);
    }

    public function listRREOAnexos($periodo, $term = null)
    {
        $anexos = SiconfiRREO::select('anexo')->where('periodo', $periodo);

        if ($term) {
            $anexos->where('anexo', 'ILIKE', "%{$term}%");
        }
        
        $anexos = $anexos->distinct()->orderBy('anexo')->get();

        return response()->json($anexos);
    }
    
    public function listRREOContasByAnexo($periodo, $anexo, $term = null)
    {
        $contas = SiconfiRREO::select('cod_conta')->where('periodo', $periodo)->where('anexo', $anexo);
        if ($term) {
            $contas->where('cod_conta', 'ILIKE', "%{$term}%");
        }

        $contas = $contas->distinct()->orderBy('cod_conta')->get();
        
        return response()->json($contas);
    }

    public function listRREOColunasByAnexoAndConta($periodo, $anexo, $conta, $term = null)
    {
        $colunas = SiconfiRREO::select('coluna')
            ->where('periodo', $periodo)
            ->where('anexo', $anexo)
            ->where('cod_conta', $conta);

        if ($term) {
            $colunas->where('coluna', 'ILIKE', "%{$term}%");
        }

        $colunas = $colunas
            ->distinct()
            ->orderBy('coluna')
            ->get();

        return response()->json($colunas);
    }

    public function listRGFAnexos($poder, $periodo, $term = null)
    {
        $anexos = SiconfiRGF::select('anexo')->where('co_poder', $poder)->where('periodo', $periodo);
        
        if ($term) {
            $anexos->where('anexo', 'ILIKE', "%{$term}%");
        }
        
        $anexos = $anexos->distinct()->orderBy('anexo')->get();

        return response()->json($anexos);
    }
    
    public function listRGFContasByAnexo($poder, $periodo, $anexo, $term = null)
    {
        $contas = SiconfiRGF::select('cod_conta')->where('co_poder', $poder)->where('periodo', $periodo)->where('anexo', $anexo);

        if ($term) {
            $contas->where('cod_conta', 'ILIKE', "%{$term}%");
        }

        $contas = $contas->distinct()->orderBy('cod_conta')->get();
        return response()->json($contas);
    }

    public function listRGFColunasByAnexoAndConta($poder, $periodo, $anexo, $conta, $term = null)
    {
        $colunas = SiconfiRGF::select('coluna')
            ->where('co_poder', $poder)
            ->where('periodo', $periodo)
            ->where('anexo', $anexo)
            ->where('cod_conta', $conta);

        if ($term) {
            $colunas->where('coluna', 'ILIKE', "%{$term}%");
        }
         
        $colunas = $colunas->distinct()->orderBy('coluna')->get();

        return response()->json($colunas);
    }
}
