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
        Schema::create('website_data', function (Blueprint $table) {
            $table->id();
            $table->integer('projects_count');
            $table->integer('units_count');
            $table->string('res_num1');
            $table->string('res_num2');
            $table->string('whats_app_num');
            $table->string('instagram_link');
            $table->string('email');
            $table->string('footer_num1');
            $table->string('footer_num2');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_data');
    }
};
