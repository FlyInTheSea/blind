<?php

namespace App\Console\Commands;

use App\Tool\template_fulfill;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;


use App\Console\Commands;

/**
 * Class create_crud_front
 * @package App\Console\Commands
 */
class create_crud_front extends Command
{
    use excute_command;

    protected $module;

    protected $module_plural;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:front_module {module}';

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
        //
        $this->module = $this->argument("module");
        $this->module_plural = str_plural($this->module);

        $this
            ->make_template()
            ->make_id()
            ->make_map_single_with_plural()
            ->make_route()
            ->make_api_url_export()
            ->make_api_url();
    }

    function make_api_url_export()
    {
        $path = Config::get("constants.path_template_id") . "/db.js";

        $template = '// import * as templates from "./database/templates"';

        $switch_template = '// templates,';


        $import = str_replace(["//", "templates"], ["", $this->module_plural], $template);

        $switch = str_replace(["{/*", "*/}", "templates"], ["", "", $this->module_plural], $switch_template);

        $template_fulfill = new template_fulfill();

        $template_fulfill->insert_file($path, $template, $import)
            ->insert_file($path, $switch_template, $switch);

        return $this;
    }

    function make_id()
    {

        $template_path = Config::get("constants.path_template_id");

        $module_id_path_format = Config::get("constants.path_id");

        $module_id_path = sprintf($module_id_path_format, $this->module);

        $template_fulfill = new template_fulfill();

        $template_fulfill->fulfill($template_path, $module_id_path, "id_template", $this->module_plural);

        return $this;

    }

    function make_route_edit()
    {
        $path = Config::get("constants.path_switch") . "/edit/edit.js";

        $template = '// import template from "../../../../containers/template/edit"';

        $switch_template = '{/*<Route path="/template/edit/:id" component={template}/>*/}';

        $import = str_replace(["//", "template"], ["", $this->module], $template);

        $switch = str_replace(["{/*", "*/}", "template"], ["", "", $this->module], $switch_template);

        $template_fulfill = new template_fulfill();

        $template_fulfill->insert_file($path, $template, $import)
            ->insert_file($path, $switch_template, $switch);

        return $this;
    }

    function make_route_table()
    {
        $path = Config::get("constants.path_switch") . "/items/table_switch.js";

        $template = '// import template from "../../../../containers/template/index"';

        $switch_template = '{/*<Route path="/template/items" component={template}/>*/}';


        $import = str_replace(["//", "template"], ["", $this->module], $template);

        $switch = str_replace(["{/*", "*/}", "template"], ["", "", $this->module], $switch_template);

        $template_fulfill = new template_fulfill();

        $template_fulfill->insert_file($path, $template, $import)
            ->insert_file($path, $switch_template, $switch);

        return $this;
    }

    function make_route_load_more()
    {
//        /www/React/src/components/forms/switch/items/.js
        $path = Config::get("constants.path_switch") . "/items/load_more_switch.js";
        $template = '// import template from "../../../../containers/template/load_more"';

        $switch_template = '{/*<Route path="/template/items" component={template}/>*/}';

        $import = str_replace(["//", "template"], ["", $this->module], $template);

        $switch = str_replace(["{/*", "*/}", "template"], ["", "", $this->module], $switch_template);

        $template_fulfill = new template_fulfill();

        $template_fulfill->insert_file($path, $template, $import)
            ->insert_file($path, $switch_template, $switch);

        return $this;
    }

    function make_route_add()
    {


        $path = Config::get("constants.path_switch") . "/add/add.js";
        $template = '// import template from "../../../../containers/template/add"';

        $switch_template = '{/*<Route path="/template/add" component={template}/>*/}';

        $import = str_replace(["//", "template"], ["", $this->module], $template);

        $switch = str_replace(["{/*", "*/}", "template"], ["", "", $this->module], $switch_template);

        $template_fulfill = new template_fulfill();

        $template_fulfill->insert_file($path, $template, $import)
            ->insert_file($path, $switch_template, $switch);

        return $this;
    }


    function make_route()
    {
        return $this
            ->make_route_add()
            ->make_route_edit()
            ->make_route_table()
            ->make_route_load_more();
    }

    /**
     * this function will insert a new key:value
     * to the third line
     *
     * example
     * const map = {
     * "as":"a"
     * }
     *
     * insert
     * "bs":"b"
     *
     * then get
     * const map = {
     *  "as":"a"
     *  "bs":"b"
     * }
     *
     * @return $this
     */
    function make_map_single_with_plural()
    {

        $path = Config::get("constants.path_table_map");

        $template = '// "templates": "template",';

        $insert = "\"{$this->module_plural}\": \"{$this->module}\",";

        $template_fulfill = new template_fulfill();

        $template_fulfill->insert_file($path, $template, $insert);

        return $this;
    }


    function make_api_url()
    {

        $url_template_path = Config::get("constants.path_template_api_database");

        $url_path_format = Config::get("constants.path_format_api_database");

        $url_path = sprintf($url_path_format, $this->module);

        $template_fulfill = new template_fulfill();

        $template_fulfill->fulfill($url_template_path, $url_path, "template", $this->module);

        return $this;
    }

    function make_template()
    {
        $app_root = Config::get("constants.path_front");
        $source = $app_root . "/containers/template";
        $target = $app_root . "/containers/" . $this->module;
        $command_format = "cp -r %s %s ";
        $command = sprintf($command_format, $source, $target);
        $this->excute_command($command);
        return $this;
    }
}
