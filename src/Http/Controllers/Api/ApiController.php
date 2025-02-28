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

    public function listRREOAnexos($term)
    {
        $anexos = SiconfiRREO::select('anexo')->where('anexo', 'ILIKE', "%{$term}%")->distinct()->get();
        return response()->json($anexos);
    }
    
    public function listRREOContasByAnexo($anexo, $term)
    {
        $contas = SiconfiRREO::select('cod_conta')->where('anexo', $anexo)->where('cod_conta', 'ILIKE', "%{$term}%")->distinct()->get();
        return response()->json($contas);
    }

    public function listRREOColunasByAnexoAndConta($anexo, $conta, $term)
    {
        $colunas = SiconfiRREO::select('coluna')
            ->where('anexo', $anexo)
            ->where('cod_conta', $conta)
            ->where('coluna', 'ILIKE', "%{$term}%")
            ->distinct()
            ->get();

        return response()->json($colunas);
    }

    public function listRGFAnexos($term)
    {
        $anexos = SiconfiRGF::select('anexo')->where('anexo', 'ILIKE', "%{$term}%")->distinct()->get();
        return response()->json($anexos);
    }
    
    public function listRGFContasByAnexo($anexo, $term)
    {
        $contas = SiconfiRGF::select('cod_conta')->where('anexo', $anexo)->where('cod_conta', 'ILIKE', "%{$term}%")->distinct()->get();
        return response()->json($contas);
    }

    public function listRGFColunasByAnexoAndConta($anexo, $conta, $term)
    {
        $colunas = SiconfiRGF::select('coluna')
            ->where('anexo', $anexo)
            ->where('cod_conta', $conta)
            ->where('coluna', 'ILIKE', "%{$term}%")
            ->distinct()
            ->get();

        return response()->json($colunas);
    }
}
