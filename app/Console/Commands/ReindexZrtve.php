<?php

namespace App\Console\Commands;

use App\Helpers\ElasticHelpers;
use App\Models\Zrtev;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Config\Definition\Exception\Exception;

class ReindexZrtve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:zrtve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex zrtve1 from database into elastic';

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

        if ($this->confirm('Are you sure you wish to reindex all zrtve 1. sv?', true)) {

            ElasticHelpers::recreateIndex();

            //$zrtve = \DB::table('ZRT1_GLAVNA_TABELA')->get();
            $zrtve = Zrtev::all();

            $cnt = 0;
            foreach ($zrtve as $zrtev) {
                $this->info($zrtev["ID"]);
                Artisan::call("reindex:zrtev", ["zrtevId" => $zrtev["ID"]]);
                $cnt++;
            }

            $this->info("All done! Zrtve reindexed: {$cnt}");
        }
    }
}
