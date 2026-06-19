<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->dateTime('check_in_time')->nullable();
            $table->string('status')->default('checked_in'); // checked_in, absent
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
