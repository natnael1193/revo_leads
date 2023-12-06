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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('phone_one')->unique();
            $table->string('phone_two')->unique()->nullable();
            $table->string('phone_three')->unique()->nullable();
            $table->string('phone_four')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('information_source');
            $table->string('property_type');
            $table->text('youtube')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('website')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('telegram')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('tiktok')->nullable();
            $table->longText('image')->nullable();
            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};