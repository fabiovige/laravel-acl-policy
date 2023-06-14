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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 200);
            $table->string('cnpj', 14);
            $table->string('responsible_name', 60);
            $table->string('cell_phone', 11);
            $table->string('email', 2000);
            $table->string('zip_code', 8);
            $table->string('address', 250);
            $table->string('number', 9)->nullable();
            $table->string('complement', 80)->nullable();
            $table->string('neighborhood', 150);
            $table->string('city', 80);
            $table->string('state', 2);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
