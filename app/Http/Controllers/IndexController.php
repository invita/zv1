<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelpers;
use App\Helpers\ContentBuilder;
use App\Helpers\ElasticHelpers;
use App\Helpers\FooterBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    public function index(Request $request)
    {


        //CommonHelpers::setLocale("en");

        $lang = App::getLocale();

        //print_r(request()->session());
        //print_r(Config::get('app.locale'));

        //print_r(App::getLocale());
        //App::setlocale("en");

        $menuId = $request->input('menuId');
        $contentHtml = "";
        if ($menuId)
            $contentHtml = ContentBuilder::getHtmlForMenuId($menuId);
        else
            $contentHtml = ContentBuilder::getHtmlForFirstPage();

        $froms = ChartController::dateInterval($lang, '1914-01', '1918-12');
        $tos = ChartController::dateInterval($lang, '1914-01', '1918-12');
        $chartDataElastic = ElasticHelpers::searchChartData(null, null, null, null);
        $chartData = ChartController::fillMissingKeysAndSort(null, null, $froms, $tos, $chartDataElastic);

        $footerHtml = FooterBuilder::getHtml();

        $viewData = [
            "search" => "",
            "zrtve" => [],
            "lang" => $lang,
            "contentHtml" => $contentHtml,
            "chartData" => $chartData,
            "footerHtml" => $footerHtml
        ];
        return view('index', $viewData);
    }
}
