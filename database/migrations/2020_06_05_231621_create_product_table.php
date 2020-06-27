<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->string('sku')->default(time());
            $table->integer('quantity')->default(1);
            $table->longText('description')->nullable();
            $table->longText('dosage')->nullable();
            $table->float('price', 200, 2)->default(0.00);
            $table->float('discount_price', 200, 2)->default(0.00)->nullable();
            $table->longText('image_url')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->boolean('hot')->default(0);
            $table->boolean('best_seller')->default(0);
            $table->boolean('new')->default(0);
            $table->boolean('landing_page')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('product');
    }
}
