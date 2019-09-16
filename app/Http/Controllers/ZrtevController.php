<?php

namespace App\Http\Controllers;

use App\Helpers\ElasticHelpers;
use App\Helpers\FieldHelpers;
use Illuminate\Http\Request;

class ZrtevController extends LayoutController
{
    public function index(Request $request)
    {
        $zrtevId = $request->input('id');

        if (!$zrtevId) die("Missing Id");
        $zrtevRest = "";

        $posFirstSep = strpos($zrtevId, "-");
        if ($posFirstSep !== false) {
            $zrtevRest = substr($zrtevId, $posFirstSep +1);
            $zrtevId = substr($zrtevId, 0, $posFirstSep);
        }

        try {
            $zrtevId = intval($zrtevId);
        } catch (\Exception $e) {
            die("Bad Id");
        }

        $zrtevElastic = ElasticHelpers::searchById($zrtevId);
        $zrtve = ElasticHelpers::elasticResultToSimpleAssocArray($zrtevElastic);

        if (!isset($zrtve[$zrtevId])) {
            return abort(404);
        }

        $zrtev = $zrtve[$zrtevId];

        $viewData = $this->getLayoutData($request, [
            "zrtevId" => $zrtevId,
            "zrtevRest" => $zrtevRest,
            "zrtev" => $zrtev,
            "fields" => FieldHelpers::$fields,
        ]);
        return view('zrtev', $viewData);
    }
}
