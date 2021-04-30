<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('quantity');
            $table->float('product_price');

            $expression = "`quantity` * `product_price`";
            $table->decimal('order_items',10,2)->storedAs($expression);
            
            $table->json('doc');
            $expression2 = "json_unquote(json_extract(`doc`,_utf8mb4'$._id'))";
            $table->string('_id')->storedAs($expression2);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE test
        ADD COLUMN `full_name` VARCHAR(500)
        AS (CONCAT_WS(" ", `first_name`, `last_name`)) AFTER `last_name`;');

        // DB::statement('ALTER TABLE test
        // ADD COLUMN `order_items` decimal(10,2)
        // AS (`quantity` * `product_price`) STORED AFTER `product_price` ;') ;

        DB::statement('ALTER TABLE `test` ADD `ip_address` VARBINARY(16) AFTER `id`');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test');

    }
};
