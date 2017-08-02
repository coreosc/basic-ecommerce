<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id')->unsigned();
            $table->integer('default_category_id')->unsigned();
            $table->float('purchase_price');
            $table->float('price')->default();
            $table->float('vat')->default(23.00);
            $table->integer('quantity');
            $table->string('name');
            $table->string('slug');
            $table->text('description_short');
            $table->text('description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->boolean('active');
            $table->string('reference');
            $table->foreign('default_category_id')->references('id')->on('categories');
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
        //
    }
}
