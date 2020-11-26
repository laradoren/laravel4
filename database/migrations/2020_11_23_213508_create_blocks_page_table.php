<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks_page', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->integer('blocks_id')->unsigned();
            $table->foreign('blocks_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('alias_of_blocks')->unsigned()->nullable();
            $table->foreign('alias_of_blocks')->references('id')->on('categories')->onDelete('cascade');
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
         Schema::create('blocks_page', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->dropForeign('blocks_page_page_id_foreign');
            $table->dropForeign('blocks_page_blocks_id_foreign');
            $table->dropForeign('blocks_page_alias_of_blocks_foreign');
        });
        Schema::dropIfExists('blocks_page');
    }
}
