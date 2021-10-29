<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockAlertsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'stock_alerts';

    /**
     * Run the migrations.
     * @table stock_alerts
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('minimum_stock_units');
            $table->string('comment', 100)->nullable()->default(null);

            $table->index(["id"], 'index_id');
            $table->index(["category_id"], 'index_category_id');
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
