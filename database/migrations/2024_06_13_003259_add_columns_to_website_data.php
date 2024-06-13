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
        Schema::table('website_data', function (Blueprint $table) {
            $table->string('who_image');
            $table->string('projects_image');
            $table->string('stages_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_data', function (Blueprint $table) {
            //
        });
    }
};
