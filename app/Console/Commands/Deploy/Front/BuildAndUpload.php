<?php

namespace App\Console\Commands\Deploy\Front;

use Illuminate\Console\Command;

class BuildAndUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "";
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
        $this->signature =
            config("constants.commands.front_build_and_upload");
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $cmd = "cd /wwwReact ";
        $cmd = "yarn build";
        $cmd = "sed -i s/\.\//\// build/index.html";
        $cmd = "rsync  build/* root@59.110.214.155:/home/wwwroot/front.com -a";
    }

    public function upa()
    {
        $cmd = "cd /www/React_Front";
        $cmd = "yarn build";
        $cmd = "sed -i s/\.\//\// build/index.html";
        $cmd = "rsync  build/* root@59.110.214.155:/home/wwwroot/back.com -a";
    }
}
