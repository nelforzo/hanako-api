<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuff', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name', 50);
            $table->string('description')->nullable()->default(null);
            $table->string('active_package_id')->nullable()->comment('package being currently used');
            $table->boolean('show_in_auto_list')->default('0')->comment('show stuff in auto list when stock level is low');

            $table->index(["user_id"], 'index_user_id');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stuff');
    }
}
