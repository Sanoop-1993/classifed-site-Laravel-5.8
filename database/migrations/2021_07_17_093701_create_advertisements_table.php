<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->integer('MainCategory_id');
            $table->integer('SubCategory_id');
            $table->string('product_name');
            $table->string('product_details');
            $table->integer('yearofpurchase');
            $table->integer('expectedsellprice');
            $table->string('owner_name');
            $table->string('mobile');
            $table->string('email');
            $table->string('state');
            $table->string('city');
            $table->text('photos');
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
        Schema::dropIfExists('advertisements');
    }
}
