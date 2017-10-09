<?php

namespace App\Console\Commands;


use App\Traits\config_data;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Mockery\Exception;

class create_crud_back_end extends Command
{
    use excute_command;
    use config_data;

    public $module;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:back_module {module}';

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

        $this->module = $this->argument("module");
        try {

            $this
                ->change_run_dir()
                ->make_route()
                ->make_controller()
                ->make_model()
                ->make_migration();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }

    }

    public function make_route()
    {
        $path = Config::get("constants.path_route_data");

        return $this->write_data($path, $this->module);
    }

    /**
     * @return $this
     */
    function make_controller()
    {
        $command_format = "php artisan make:controller %s -r ";
        $command = sprintf($command_format, $this->module);
        $this->excute_command($command);

        return $this;
    }

    function make_model()
    {
        $command_format = "php artisan make:model %s  ";
        $command = sprintf($command_format, $this->module);
        $this->excute_command($command);
        return $this;
    }

    function make_migration()
    {
        $command_format = "php artisan make:migration %s  ";
        $command = sprintf($command_format, $this->module);
        $this->excute_command($command);
        return $this;
    }

}
