<?php

namespace App\Console\Commands;

use App\Helpers\ElasticHelpers;
use App\Models\Entity;
use App\Models\Zrtev;
use Illuminate\Console\Command;
use Symfony\Component\Config\Definition\Exception\Exception;

class ReindexZrtev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:zrtev {zrtevId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex a single zrtev';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $zrtevId = $this->argument('zrtevId');
        $this->info("Indexing zrtev {$zrtevId}");

        $zrtev = Zrtev::find($zrtevId)->toArray();
        if ($zrtev) {

            $dateFieldsToParse = ["ROJSTVO", "SMRT"];
            foreach ($dateFieldsToParse as $dateField) {
                $date = isset($zrtev[$dateField]) ? $zrtev[$dateField] : null;
                if ($date) {
                    try {
                        $dateYearMonth = $this->parseYearMonth($date);
                        if ($dateYearMonth["LETO"]) $zrtev[$dateField."_LETO"] = $dateYearMonth["LETO"];
                        if ($dateYearMonth["MESEC"]) $zrtev[$dateField."_MESEC"] = $dateYearMonth["MESEC"];
                    } catch (\Exception $e) {
                        $this->warn("Error trying to parseYearMonth '".$date."'");
                    }
                }
            }

            //print_r($zrtev);
            $indexBody = $zrtev;
            ElasticHelpers::indexZrtev($zrtevId, $indexBody);
        } else {
            ElasticHelpers::deleteZrtev($zrtevId);
        }

        //print_r($entity);
        //$this->info("Indexing {$entity["entity_type_id"]->toArray()}");
    }

    private function parseYearMonth($date) {
        $result = [
            "MESEC" => null,
            "LETO" => null
        ];

        $date = preg_replace('/\s/', "", $date);
        $dateSplit = preg_split('/[\-\.\/]/', $date);

        if (preg_match('/[\d]{1,2}.[\d]{1,2}.[\d]{4}/', $date)) {
            // DD.MM.YYYY
            $result["LETO"] = intval($dateSplit[2]);
            $result["MESEC"] = intval($dateSplit[1]);
        } else if (preg_match('/[\d]{4}.[\d]{1,2}.[\d]{1,2}/', $date)) {
            // YYYY.MM.DD
            $result["LETO"] = intval($dateSplit[0]);
            $result["MESEC"] = intval($dateSplit[1]);
        } else if (preg_match('/[\d]{1,2}.[\d]{4}/', $date)) {
            // MM.YYYY
            $result["LETO"] = intval($dateSplit[1]);
            $result["MESEC"] = intval($dateSplit[0]);
        } else if (preg_match('/[\d]{4}.[\d]{1,2}/', $date)) {
            // YYYY.MM
            $result["LETO"] = intval($dateSplit[0]);
            $result["MESEC"] = intval($dateSplit[1]);
        } else if (preg_match('/[\d]{4}/', $date)) {
            // YYYY only
            $result["LETO"] = intval($date);
        }

        return $result;
    }
}
