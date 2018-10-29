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

        $indexExists = \Elasticsearch::connection()->indices()->exists([
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1")
        ]);
        if ($indexExists) {
            $deleteIndexArgs = [
                "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            ];
            \Elasticsearch::connection()->indices()->delete($deleteIndexArgs);
        }

        $createIndexArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
        ];
        $createIndexArgs["body"] = <<<HERE
{
    "settings": {
        "number_of_shards": 1,
        "number_of_replicas": 0,
        "analysis": {
            "analyzer": {
                "lowercase_analyzer": {
                    "type": "custom",
                    "tokenizer": "standard",
                    "filter": [ "lowercase" ]
                }
            }
        }
    },
    "mappings": {
        "zrtev1": {
            "date_detection": false
        }
    }
}
HERE;

        return \Elasticsearch::connection()->indices()->create($createIndexArgs);

        /*

        $deleteIndexArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => "",
            "id" => "",
        ];
        \Elasticsearch::connection()->delete($deleteIndexArgs);

        $createIndexArgs = [
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev1"),
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
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev1"),
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
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev1"),
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
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev1"),
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
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev1"),
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
            "index" => env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1"),
            "type" => env("SI4_ELASTIC_ZRTVE_DOCTYPE", "zrtev1"),
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