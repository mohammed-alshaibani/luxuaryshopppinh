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
        Schema::create('_m_y_l', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('qty');
            $table->string('size');
            $table->string('color');
            $table->string('price');
            $table->string('note');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_m_y_l');
    }
};
