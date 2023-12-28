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
        Schema::create('detail_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extra_id');
            $table->unsignedBigInteger('gallery_id');
            $table->timestamps();

            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_extras');
    }
};
