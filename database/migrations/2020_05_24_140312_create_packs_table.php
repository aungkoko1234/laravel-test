<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('description');
            $table->integer('total_credit');
            $table->integer('validity_month');
            $table->float('price');
            $table->float('estimate_price');
            $table->integer('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->integer('alias_id')->references('id')->on('aliases')->onDelete('cascade');
            $table->integer('type_id')->references('id')->on('types')->onDelete('cascade');
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
        Schema::dropIfExists('packs');
    }
}
