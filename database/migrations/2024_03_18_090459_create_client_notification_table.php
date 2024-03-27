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
        Schema::create('client_notification', function (Blueprint $table) {
            $table->id();
            $table->enum('is_read',['read','unread']);
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete(); 
            $table->foreignId('notification_id')->nullable()->constrained('notifications')->nullOnDelete(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_notification');
    }
};
