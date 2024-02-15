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
        Schema::create('stoves', function (Blueprint $table) {
            $table->id();
            $table->integer('burners');

            $table->integer('lighters');
            $table->string('lighters_colors');

            $table->integer('oven');
            $table->integer('oven_lamp');
            $table->string('oven_lamp_color');
            $table->string('oven_color');
            $table->string('stove_color');

            $table->string('stove_width');
            $table->string('stove_height');
            $table->string('stove_depth');

            $table->integer('glass_width');
            $table->integer('glass_height');
            $table->integer('glass_lenght');

            $table->string('brand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoves');
    }
};
