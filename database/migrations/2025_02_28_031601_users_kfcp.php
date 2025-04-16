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
        Schema::create('users_kfcp', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->nullable()->unique();  // or with default value
            $table->string('email')->unique()->nullable();
            $table->string('fName')->nullable();
            $table->string('lName')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('password')->nullable();
            $table->string('is_authorized')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_kfcp');
    }
};
