<?php

namespace App\Http\Controllers;

use App\Models\Zrtev;
use Illuminate\Http\Request;
use App\Helpers\ElasticHelpers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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

    public function reindex(Request $request) {
        $pass = $request->input('pass');
        if ($pass !== env("SI4_REINDEX_API_PASS")) return response('', 403);

        $fromId = intval($request->input('fromId'));
        $toId = intval($request->input('toId'));

        $query = DB::table("ZRT1_GLAVNA_TABELA")
            ->where("id", ">=", $fromId)
            ->where("id", "<=", $toId);

        $rowCount = $query->count();
        $zrtve = $query->get();

        if ($rowCount) {
            // Single or Mass reindex
            foreach ($zrtve as $zrtev) {
                Artisan::call("reindex:zrtev", ["zrtevId" => $zrtev->ID]);
            }
        } else {
            // Deletion
            if ($fromId == $toId) {
                Artisan::call("reindex:zrtev", ["zrtevId" => $fromId]);
            }
        }

        $result = [
            "status" => true,
            "count" => $rowCount,
        ];

        return json_encode($result);

    }
}
