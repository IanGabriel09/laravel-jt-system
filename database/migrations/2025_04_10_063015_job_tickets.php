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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->nullable()->unique();  
            $table->string('user_id')->nullable();  
            $table->string('location')->nullable();  
            $table->string('ticket_subj')->nullable();
            $table->text('ticket_description')->nullable(); // Best for long plain text
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('user_id')
                ->references('id_number')
                ->on('users_kfcp')
                ->onDelete('set null'); // Optional: choose what happens on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
