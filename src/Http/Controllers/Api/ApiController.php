<?php

namespace Bradoctech\SapcNovaCkEditor\Http\Controllers\Api;

use App\Models\Sapc\Formula;
use App\Models\Sapc\VariavelContaGestao;
use App\Models\Sapc\VariavelContaGoverno;

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

    public function listRREOAnexos()
    {
        $anexos = SiconfiRREO::select('anexo')->distinct()->get();
        return response()->json($anexos);
    }
    
    public function listRREOContasByAnexo($anexo)
    {
        $contas = SiconfiRREO::select('conta')->where('anexo', $anexo)->distinct()->get();
        return response()->json($contas);
    }

    public function listRREOColunasByAnexoAndConta($anexo, $conta)
    {
        $colunas = SiconfiRREO::select('coluna')
            ->where('anexo', $anexo)
            ->where('conta', $conta)
            ->distinct()
            ->get();

        return response()->json($colunas);
    }

    public function listRREOAnexos()
    {
        $anexos = SiconfiRREO::select('anexo')->distinct()->get();
        return response()->json($anexos);
    }
    
    public function listRREOContasByAnexo($anexo)
    {
        $contas = SiconfiRREO::select('conta')->where('anexo', $anexo)->distinct()->get();
        return response()->json($contas);
    }

    public function listRREOColunasByAnexoAndConta($anexo, $conta)
    {
        $colunas = SiconfiRREO::select('coluna')
            ->where('anexo', $anexo)
            ->where('conta', $conta)
            ->distinct()
            ->get();

        return response()->json($colunas);
    }
    public function listRGFAnexos()
    {
        $anexos = SiconfiRGF::select('anexo')->distinct()->get();
        return response()->json($anexos);
    }
    
    public function listRGFContasByAnexo($anexo)
    {
        $contas = SiconfiRGF::select('conta')->where('anexo', $anexo)->distinct()->get();
        return response()->json($contas);
    }

    public function listRGFColunasByAnexoAndConta($anexo, $conta)
    {
        $colunas = SiconfiRGF::select('coluna')
            ->where('anexo', $anexo)
            ->where('conta', $conta)
            ->distinct()
            ->get();

        return response()->json($colunas);
    }
}
