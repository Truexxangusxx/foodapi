<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGustoToProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proveedors', function (Blueprint $table) {
            $table->integer('gusto_id')->unsigned()->nullable();
            $table->foreign('gusto_id')->references('id')->on('gustos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proveedors', function (Blueprint $table) {
            $table->dropColumn('gusto_id');
        });
    }
}
