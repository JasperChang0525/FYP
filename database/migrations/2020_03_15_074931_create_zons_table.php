<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zon_ukm');
            $table->tinyInteger('zonlist_id');
            $table->string('checkpoint');
            $table->double('lat',20,10);
            $table->string('lng',20,10);
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
        Schema::dropIfExists('zons');
    }
}
