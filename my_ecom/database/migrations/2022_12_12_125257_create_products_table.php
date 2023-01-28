<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->longtext('short_desc');
            $table->longtext('desc');
            $table->longtext('keywords');
            $table->longtext('technical_specification');
            $table->longtext('uses');
            $table->longtext('warranty');
            $table->integer('status');
            $table->string('image');
            $table->string('lead_time');
            $table->integer('tax_id');
            $table->integer('is_featured');
            $table->integer('is_discounted');
            $table->integer('is_tranding');
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
        Schema::dropIfExists('products');
    }
}
