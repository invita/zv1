<?php

namespace App\Http\Controllers;

use App\Helpers\ElasticHelpers;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        //$zrtve = \DB::table('ZRT1_GLAVNA_TABELA')->get();

        $search = $request->input('search');
        $zrtve = [];
        if ($search) {
            $zrtveElastic = ElasticHelpers::search($search);
            $zrtve = ElasticHelpers::elasticResultToSimpleAssocArray($zrtveElastic);
        }
        //print_r($zrtve);


        $viewData = [
            "search" => $search,
            "zrtve" => $zrtve,
        ];
        return view('index', $viewData);
    }
}
