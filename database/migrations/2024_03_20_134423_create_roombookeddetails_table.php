<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roombookeddetails', function (Blueprint $table) {
            $table->id();
            $table->integer('houseid');
            $table->string('name');
            $table->integer('mobileno');
            $table->string('address');
            $table->string('housename');
            $table->string('houseaddress');
            $table->integer('maxdaycount');
            $table->integer('amountpaid');
            $table->integer('amount');
            $table->integer('status');
            $table->string('proof');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roombookeddetails');
    }
};
