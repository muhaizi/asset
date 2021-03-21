<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * upload text
         * radio button tinyint
         * dropdown $table->integer('parent_id')->nullable();
         * figure $table->decimal('current_value',11,2)->comment('purchase price - depreciation (asset depre Total)');
         * calendar $table->date('deadline');
         * keterangan ->text
         * modal popup
         */
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->integer('ministry_id')->nullable();
            $table->text('attachment');
            $table->text('description');
            $table->tinyInteger('status')->nullable(); //1,2,3
            $table->date('deadline'); 
            $table->decimal('amount',11,2)->comment('tab 2'); //1,2,3
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
