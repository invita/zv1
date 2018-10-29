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

        $zrtev = Zrtev::find($zrtevId);
        if ($zrtev) {
            /*
            $indexBody = [
                "id" => $zrtevId,
                "data" => $zrtev
            ];
            */
            $indexBody = $zrtev;
            ElasticHelpers::indexZrtev($zrtevId, $indexBody);
        } else {
            ElasticHelpers::deleteZrtev($zrtevId);
        }

        //print_r($entity);
        //$this->info("Indexing {$entity["entity_type_id"]->toArray()}");


    }
}
