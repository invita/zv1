<?php

namespace App\Console\Commands;

use App\Helpers\ElasticHelpers;
use App\Models\Entity;
use App\Models\Zrtev;
use Illuminate\Console\Command;
use Symfony\Component\Config\Definition\Exception\Exception;

class RecreateIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:recreate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recreate empty index only';

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
        if ($this->confirm('Are you sure you wish to recreate index?', true)) {
            ElasticHelpers::recreateIndex();
            $this->info("Index '".env("SI4_ELASTIC_ZRTVE_INDEX", "zrtve1")."' recreated");
        }
    }
}
