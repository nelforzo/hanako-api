<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'logs';

    /**
     * Run the migrations.
     * @table stuff_logs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('operation', 50)->default('');
            $table->integer('user_id');
            $table->integer('stuff_id');
            $table->integer('package_id')->nullable();

            $table->index(["user_id"], 'index_user_id');
            $table->index(["stuff_id"], 'index_stuff_id');
            $table->index(["package_id"], 'index_package_id');
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
        Schema::dropIfExists($this->tableName);
    }
}
