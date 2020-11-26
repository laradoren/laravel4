<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlocksIdPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('blocks_id')->unsigned()->nullable();
            $table->foreign('blocks_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->integer('alias_of')->unsigned()->nullable();
            $table->foreign('alias_of')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_alias_of_foreign');
            $table->dropForeign('pages_blocks_id_foreign');
        });
    }
}
