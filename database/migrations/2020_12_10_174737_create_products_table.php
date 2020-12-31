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
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->string('cover')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('has_offer')->default(0); //0 is false and 1 is true
            $table->boolean('offer_type')->default(0); //0 for amount and for percentage
            $table->integer('percent_off')->nullable();
            $table->integer('amount_off')->nullable();
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
