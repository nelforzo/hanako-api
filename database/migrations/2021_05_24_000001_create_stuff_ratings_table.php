<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuffRatingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'stuff_ratings';

    /**
     * Run the migrations.
     * @table stuff_ratings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('stuff_id')->nullable()->default(null);
            $table->integer('rating')->nullable()->default(null)->comment('item rating from 0 to 10');
            $table->string('comment', 100)->nullable()->default(null);

            $table->index(["stuff_id"], 'index_stuff_id');
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
