<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('status');
            $table->string('type');
            $table->integer('price')->unsigned();
            $table->decimal('area', 12, 2)->unsigned();
            $table->string('area_type')->default('sqft');
            $table->smallInteger('rooms')->unsigned()->nullable();
            $table->text('images')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('zipcode')->unsigned();
            $table->text('description')->nullable();
            $table->text('detailed_info')->nullable();
            // $table->smallInteger('building_age')->unsigned()->nullable();
            // $table->smallInteger('bedrooms')->unsigned()->nullable();
            // $table->smallInteger('bathrooms')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
