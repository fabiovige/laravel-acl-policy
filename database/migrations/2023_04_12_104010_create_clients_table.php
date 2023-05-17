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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('corporate_name', 150);
            $table->string('cnpj', 14);
            $table->string('responsible_name', 50);
            $table->string('cell_phone', 11);
            $table->string('email', 150);
            $table->string('zip_code', 8);
            $table->string('address', 200);
            $table->string('number', 9)->nullable();
            $table->string('complement', 60)->nullable();
            $table->string('neighborhood', 100);
            $table->string('city', 50);
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
