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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->char('type');
            $table->foreignId('category_id')
            ->nullable()
            ->constrained()
            ->onDelete('restrict');
            $table->timestamps();

            //->onUpdate('cascade')
            //->onDelete('cascade')

            /*[CONSTRAINT [symbol]] FOREIGN KEY
            [index_name] (col_name, ...)
            REFERENCES tbl_name (col_name,...)
            [ON DELETE reference_option]
            [ON UPDATE reference_option]

            reference_option:
            RESTRICT | CASCADE | SET NULL | NO ACTION | SET DEFAULT*/

            //https://dev.mysql.com/doc/refman/8.0/en/create-table-foreign-keys.html
        });

        DB::statement("ALTER TABLE `categories` ADD UNIQUE( `title`, `type`, `category_id`);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
