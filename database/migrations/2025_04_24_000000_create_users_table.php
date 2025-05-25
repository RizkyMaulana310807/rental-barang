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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('role')->default('user');
            $table->boolean('isGuru')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
