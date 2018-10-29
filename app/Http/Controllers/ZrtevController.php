<?php

namespace App\Http\Controllers;

use App\Helpers\ElasticHelpers;
use Illuminate\Http\Request;

class ZrtevController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $id = $request->input('id');

        $zrtev = [];
        if ($id) {
            $zrtevElastic = ElasticHelpers::searchById($id);
            $zrtev = ElasticHelpers::elasticResultToSimpleAssocArray($zrtevElastic)[$id];
        }

        //print_r($zrtev);


        $viewData = [
            "search" => $search,
            "zrtev" => $zrtev,
        ];
        return view('zrtev', $viewData);
    }
}
