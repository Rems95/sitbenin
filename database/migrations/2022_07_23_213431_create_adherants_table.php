<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdherantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adherants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('firm_name')->unique();
            $table->date('firm_create_date');
            $table->string('firm_ifu')->unique()->nullable();
            $table->string('personnal_ifu')->unique()->nullable();
            $table->string('trade_register_number')->unique()->nullable();
            $table->integer('subsector_id')->unsigned();
            $table->foreign('subsector_id')->references('id')->on('subsectors')->onDelete('cascade');
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
        Schema::dropIfExists('adherants');
    }
}
