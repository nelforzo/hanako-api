<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuffsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'stuffs';

    /**
     * Run the migrations.
     * @table stuffs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('name');
            $table->integer('description')->nullable()->default(null);
            $table->integer('brand')->nullable()->default(null);
            $table->integer('comment')->nullable()->default(null);
            $table->integer('barcode')->nullable()->default(null);
            $table->string('uuid', 50)->default('')->comment('the system unique identifier used for qr code urls');
            $table->integer('units_per_package');
            $table->integer('mililiters_per_package')->nullable()->default(null);
            $table->timestamp('expiration_date')->nullable()->default(null)->comment('the item\'s expiration date when unopened');
            $table->timestamp('opened_date')->nullable()->default(null)->comment('the item\'s opened date');
            $table->integer('consume_before_days')->nullable()->default(null)->comment('the maximum number of days the item can be used after opening');

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
        Schema::dropIfExists($this->tableName);
    }
}