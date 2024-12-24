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
        Schema::create('post_office_wards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->integer('post_office_id');
            $table->integer('source_ward_id');
            $table->integer('destination_ward_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_office_wards');
    }
};
