<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelpers;
use App\Helpers\ContentBuilder;
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


        $footerHtml = FooterBuilder::getHtml();

        $viewData = [
            "search" => "",
            "zrtve" => [],
            "lang" => $lang,
            "contentHtml" => $contentHtml,
            "footerHtml" => $footerHtml
        ];
        return view('index', $viewData);
    }
}
