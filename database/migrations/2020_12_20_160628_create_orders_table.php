<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('quantity');
            $table->dateTime('delivered_at')->nullable();
            $table->string('charge_id')->nullable();
            $table->string('status');
            $table->string('billing_email')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_province')->nullable();
            $table->string('billing_postalcode')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_name_on_card')->nullable();
            $table->string('billing_discount')->default(0);
            $table->string('billing_discount_code')->nullable();
            $table->string('billing_total')->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('street_address')->nullable();
            $table->string('optional')->nullable();
            $table->string('note')->nullable();
            $table->string('deliveryTime')->nullable();
            $table->text('error')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->string('priority')->default(3);
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
        Schema::dropIfExists('orders');
    }
}
