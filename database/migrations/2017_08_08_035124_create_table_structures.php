<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\SoftDeletes;

class CreateTableStructures extends Migration
{
    use SoftDeletes;

    public function up()
    {
        Schema::create('table_structures', function (Blueprint $table) {
            $table->string('name')->comment("表名")->unique();
            $table->increments('id');
            $table->tinyInteger("status")->default(0)
                ->comment('0 stand for show 1 stand for not show ');
            $table->string("name_alias")->comment("表名英文");
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::query();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "table_structures";
        $table_structure_first_row->name_alias = "表单结构管理";
        $table_structure_first_row->save();


        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "columns";
        $table_structure_first_row->name_alias = "字段名";
        $table_structure_first_row->save();
        //插入默认数据
//        insert into table_structures (name , ) values("","");

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "cities";
        $table_structure_first_row->name_alias = "城市";
        $table_structure_first_row->save();


        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "channels";
        $table_structure_first_row->name_alias = "渠道";
        $table_structure_first_row->save();


        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "daily_reports";
        $table_structure_first_row->name_alias = "日报";
        $table_structure_first_row->save();


        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "users";
        $table_structure_first_row->name_alias = "用户";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "communities";
        $table_structure_first_row->name_alias = "小区";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "houses";
        $table_structure_first_row->name_alias = "房间";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "config_transformations";
        $table_structure_first_row->name_alias = "配置名称";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "funds";
        $table_structure_first_row->name_alias = "资金";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "upload_files";
        $table_structure_first_row->name_alias = "文件";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "customers";
        $table_structure_first_row->name_alias = "顾客";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "customer_info";
        $table_structure_first_row->name_alias = "顾客详情";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "customer_levels";
        $table_structure_first_row->name_alias = "顾客评级";
        $table_structure_first_row->save();


        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "contracts";
        $table_structure_first_row->name_alias = "合同";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "roles";
        $table_structure_first_row->name_alias = "角色";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "permissions";
        $table_structure_first_row->name_alias = "权限";
        $table_structure_first_row->save();

        // real table is permission_roles;
        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "permission_roles";
        $table_structure_first_row->name_alias = "角色权限";
        $table_structure_first_row->save();



        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "community_roles";
        $table_structure_first_row->name_alias = "项目管理人员";
        $table_structure_first_row->save();

        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "community_sellers";
        $table_structure_first_row->name_alias = "项目销售";
        $table_structure_first_row->save();


        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "commission";
        $table_structure_first_row->name_alias = "佣金";
        $table_structure_first_row->save();



        $table_structure_first_row = new  \App\table_structure();
        $table_structure_first_row->name = "customer_owners";
        $table_structure_first_row->name_alias = "顾客归属";
        $table_structure_first_row->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_structures');
    }
}
