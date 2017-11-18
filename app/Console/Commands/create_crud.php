<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class create_crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:module {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    public $module;

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
        $this->module = $this->argument("module");
        $this->make_front()
            ->make_back_end();
    }

    function make_front()
    {
        $exitCode = $this->call('generate:front_module', ["module" => $this->module]);
        return $this;
    }

    function make_back_end()
    {

        $exitCode = $this->call('generate:back_module', ["module" => $this->module]);
        return $this;
    }


}
