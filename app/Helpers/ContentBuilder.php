<?php
namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Class ContentBuilder
 *
 * @author   Matic Vrscaj
 */
class ContentBuilder
{

    /**
     * Build content html
     */
    public static function getHtmlForMenuId($menuId)
    {

        $lang = App::getLocale();
        $query = <<<HERE
            SELECT * FROM NAV_GLAVNA_TABELA_ZRTVE1 gt
                INNER JOIN NAV_STRUCTURE_ZRTVE1 s ON s.ID = gt.ID
                WHERE gt.language='{$lang}' AND s.ID = {$menuId}
                LIMIT 1
HERE;

        $items = CommonHelpers::dbToArray(DB::select($query));
        return isset($items[0]) ? $items[0]["CONTENT"] : "";
    }

    public static function getHtmlForFirstPage() {
        $lang = App::getLocale();
        $query = <<<HERE
            SELECT * FROM NAV_GLAVNA_TABELA_ZRTVE1 gt
                INNER JOIN NAV_STRUCTURE_ZRTVE1 s ON s.ID = gt.ID
                WHERE gt.language='{$lang}' AND s.FIRST_PAGE = 1
                LIMIT 1
HERE;

        $items = CommonHelpers::dbToArray(DB::select($query));
        $content = isset($items[0]) ? $items[0]["CONTENT"] : "";
        $content = self::replaceCommonPlaceholders($content);
        return $content;
    }

    public static function replaceCommonPlaceholders($content) {
        $zrt1Count = DB::table('ZRT1_GLAVNA_TABELA')->count();
        $zrt1LastModified = DB::table('ZRT1_GLAVNA_TABELA')->max('LAST_MODIFIED');
        $zrt1LastModifiedFormat = date("d.m.Y", strtotime($zrt1LastModified));

        $replaceMap = [
            "[[steviloZrtev]]" => $zrt1Count,
            "[[zadnjaPosodobitev]]" => $zrt1LastModifiedFormat,
        ];

        foreach ($replaceMap as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        return $content;
    }
}