<?php

namespace Mostafaznv\NovaCkEditor\Http\Controllers\Api;

use App\Models\Sapc\Formula;
use App\Models\Sapc\Variavel;

use Illuminate\Routing\Controller;


class ApiController extends Controller
{
    public function searchVariaveis($term)
    {
        $listaVariavel = Variavel::where('nome', 'LIKE', "%{$term}%")->get();
        return response()->json($listaVariavel);
    }

    public function searchFormulas($term)
    {
        $listaFormula = Formula::where('nome', 'LIKE', "%{$term}%")->get();
        return response()->json($listaFormula);
    }
}
