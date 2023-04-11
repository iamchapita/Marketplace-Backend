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
        Schema::table('directions', function (Blueprint $table) {
            $table->foreign('userIdFK')->references('id')->on('users');
            $table->foreign('departmentIdFK')->references('id')->on('departments');
            $table->foreign('municipalityIdFK')->references('id')->on('municipalities');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('userIdFK')->references('id')->on('users');
            $table->foreign('categoryIdFK')->references('id')->on('categories');
        });

        Schema::table('municipalities', function (Blueprint $table) {
            $table->foreign('departmentIdFK')->references('id')->on('departments');
        });

        Schema::table('wish_lists', function (Blueprint $table) {
            $table->foreign('userIdFK')->references('id')->on('users');
            $table->foreign('productIdFK')->references('id')->on('products');
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->foreign('userIdFK')->references('id')->on('users');
            $table->foreign('userIdReported')->references('id')->on('users');
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
