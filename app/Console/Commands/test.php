<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "test";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date = 20170920;
        echo Carbon::createFromFormat("Ymd",$date)->timestamp*1000;
        echo PHP_EOL;
        //
        $num = 1506096000000;
        echo $num;
        die();
        echo (int)Carbon::createFromTimestamp($num / 1000)->format("Ymd");
    }
}
