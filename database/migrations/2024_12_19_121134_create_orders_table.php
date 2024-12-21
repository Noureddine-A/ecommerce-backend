<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("price");
            $table->integer("user_id")->nullable(false);
            $table->string("streetName")->nullable(false);
            $table->string("city")->nullable(false);
            $table->string("state");
            $table->string("zipcode")->nullable(false);
            $table->string("country")->nullable(false);
            $table->string("phone");
            $table->string("firstName");
            $table->string("lastName");
            $table->string("email");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
