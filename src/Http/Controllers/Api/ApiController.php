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
}
