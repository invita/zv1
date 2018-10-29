<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ElasticHelpers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $result = array(
            "status" => true
        );
        return json_encode($result);
    }

    public function search(Request $request)
    {
        $input =  file_get_contents("php://input");
        $inputJson = json_decode($input, true);
        $search = $inputJson["staticData"]["search"];

        $pageStart = $inputJson["pageStart"];
        $pageCount = $inputJson["pageCount"];
        $sortField = $inputJson["sortField"];
        $sortOrder = $inputJson["sortOrder"];

        $filter = $inputJson["filter"];

        $zrtve = [];
        $rowCount = 0;
        if ($search) {
            $zrtveElastic = ElasticHelpers::search($search, $filter, $pageStart, $pageCount, $sortField, $sortOrder);

            $rowCount = $zrtveElastic["hits"]["total"];
            $zrtve = ElasticHelpers::elasticResultToSimpleArray($zrtveElastic);
        }


        //print_r($zrtveElastic);

        $result = array(
            "search" => $search,
            "rowCount" => $rowCount,
            "status" => true,
            "data" => $zrtve,
        );

        return response(json_encode($result))->header('Content-Type', 'application/json');
    }

    public function dictionary(Request $request) {
        $input =  file_get_contents("php://input");
        $inputJson = json_decode($input, true);
        $lang = $inputJson["lang"];

        if ($lang == "eng" || $lang == "en")
            $lang = "en";
        else
            $lang = "sl";

        App::setLocale($lang);
        $result = Lang::get("zrtve1");
        return json_encode($result);
    }
}
