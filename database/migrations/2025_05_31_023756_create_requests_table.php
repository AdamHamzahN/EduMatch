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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->text('pesan')->default('-');
            $table->enum('status',['menunggu','ditolak','diterima'])->default('menunggu');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('murid_id');
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
            $table->foreign('murid_id')->references('id')->on('murids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
