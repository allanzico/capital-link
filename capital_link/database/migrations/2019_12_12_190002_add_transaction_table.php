<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('owner_id');
            $table->float('amount');
            $table->date('date');
            $table->string('payment_type');
            $table->string('payed_for');
            $table->string('owner_name');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('financial_year_id');
            $table->timestamps();

            //Foreign constraints
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('financial_year_id')->references('id')->on('financial_year')->onDelete('cascade');
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
