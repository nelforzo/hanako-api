<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'packages';

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
            $table->integer('category_id');
            $table->string('name', 50);
            $table->string('description')->nullable()->default(null);
            $table->string('brand', 50)->nullable()->default(null);
            $table->string('comment', 100)->nullable()->default(null);
            $table->string('barcode', 50)->nullable()->default(null);
            $table->string('uuid', 50)->default('')->comment('the system unique identifier used for qr code urls');
            $table->integer('units_per_package');
            $table->integer('mililiters_per_package')->nullable()->default(null);
            $table->timestamp('expiration_date')->nullable()->default(null)->comment('the item\'s expiration date when unopened');
            $table->timestamp('opened_date')->nullable()->default(null)->comment('the item\'s opened date');
            $table->integer('consume_before_days')->nullable()->default(null)->comment('the maximum number of days the item can be used after opening');

            $table->index(["id"], 'index_id');
            $table->index(["user_id"], 'index_user_id');
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
