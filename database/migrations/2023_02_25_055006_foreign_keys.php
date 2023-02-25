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
        Schema::table('Direction', function (Blueprint $table) {
            $table->foreign('userIdFK')->references('id')->on('User');
        });

        Schema::table('Product', function (Blueprint $table) {
            $table->foreign('userIdFK')->references('id')->on('User');
        });

        Schema::table('ProductSeller', function (Blueprint $table) {
            $table->foreign('productIdFK')->references('id')->on('Product');
            $table->foreign('userIdFK')->references('id')->on('User');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
