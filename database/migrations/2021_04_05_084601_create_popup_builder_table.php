<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupBuilderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_builder', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('only_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('offer_time_end')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('btn_status')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('popup_builder');
    }
}
