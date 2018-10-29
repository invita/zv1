<?php
namespace App\Helpers;

/**
 * Class ElasticHelper
 *
 * @author   Matic Vrscaj
 */
class ElasticHelpers
{

    /**
     * Delete and create index
     */
    public static function recreateIndex()
    {

        $deleteIndexArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => "",
            "id" => "",
        ];
        \Elasticsearch::connection()->delete($deleteIndexArgs);

        /*
        $createIndexArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev"),
            "id" => "",
            "body" => []
        ];
        return @\Elasticsearch::connection()->create($createIndexArgs);
        */
    }


    /**
     * Sends a document to elastic search to be indexed
     * @param $zrtevId Integer entity id to index
     * @param $body Array body to index
     * @return array
     */
    public static function indexZrtev($zrtevId, $body)
    {
        $requestArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev"),
            "id" => $zrtevId,
            "body" => $body
        ];
        return \Elasticsearch::connection()->index($requestArgs);
    }

    /**
     * Delete a document from elastic search index
     * @param $zrtevId Integer entity id to delete
     * @return array
     */
    public static function deleteZrtev($zrtevId)
    {
        $requestArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev"),
            "id" => $zrtevId,
        ];
        return \Elasticsearch::connection()->delete($requestArgs);
    }

    /**
     * Retrieves all matching documents from elastic search
     * @param $query String to match
     * @param $offset Integer offset
     * @param $limit Integer limit
     * @return array
     */
    public static function search($query, $offset = 0, $limit = 10)
    {
        $requestArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev"),
            "body" => [
                "query" => [
                    "query_string" => [
                        "query" => $query
                    ]
                ]

                //"sort" => "id",
                //"from" => $offset,
                //"size" => $limit,
            ]
        ];
        return \Elasticsearch::connection()->search($requestArgs);
    }

    public static function searchByIdArray($idArray)
    {
        $requestArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev"),
            "body" => [
                "query" => [
                    "ids" => [
                        "values" => $idArray
                    ]
                ]
            ]
        ];
        $dataElastic = \Elasticsearch::connection()->search($requestArgs);
        return self::mergeElasticResultAndIdArray($dataElastic, $idArray);
    }

    public static function searchById($idArray)
    {
        $requestArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev"),
            "body" => [
                "query" => [
                    "ids" => [
                        "values" => [ $idArray ]
                    ]
                ]
            ]
        ];
        $dataElastic = \Elasticsearch::connection()->search($requestArgs);
        return $dataElastic;
    }



    public static function elasticResultToAssocArray($dataElastic) {
        $result = [];
        if (isset($dataElastic["hits"]) && isset($dataElastic["hits"]["hits"])) {
            foreach ($dataElastic["hits"]["hits"] as $hit){
                $result[$hit["_id"]] = [
                    "id" => $hit["_id"],
                    "_source" => $hit["_source"],
                ];
            }
        }
        return $result;
    }

    public static function mergeElasticResultAndIdArray($dataElastic, $idArray) {
        $hits = self::elasticResultToAssocArray($dataElastic);

        $result = [];
        foreach ($idArray as $id) $result[$id] = ["id" => $id];
        foreach ($result as $i => $val) {
            if (isset($hits[$i])) $result[$i]["_source"] = $hits[$i]["_source"];
        }
        return $result;
    }

    public static function elasticResultToSimpleAssocArray($dataElastic) {
        $result = [];
        if (isset($dataElastic["hits"]) && isset($dataElastic["hits"]["hits"])) {
            foreach ($dataElastic["hits"]["hits"] as $hit){
                $result[$hit["_id"]] = $hit["_source"];
            }
        }
        return $result;
    }
}