<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('key');
            $table->string('name');
            $table->string('zone_type');
            $table->string('locality_id');
            $table->unsignedBigInteger('federal_entity_id');
            $table->unsignedBigInteger('settlement_type_id');
            $table->unsignedBigInteger('municipality_id');
            $table->foreign('locality_id')->references('zip_code')->on('localities');
            $table->foreign('federal_entity_id')->references('key')->on('federal_entities');
            $table->foreign('settlement_type_id')->references('key')->on('settlement_types');
            $table->foreign('municipality_id')->references('key')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
