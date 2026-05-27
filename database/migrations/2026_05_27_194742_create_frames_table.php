<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->id();

            $table->foreignId('session_id')
                ->constrained('camera_sessions')
                ->cascadeOnDelete();

            $table->string('filename');

            $table->string('path');

            // waktu frame diambil dari device
            $table->timestamp('captured_at');

            // score motion detection dari android
            $table->float('motion_score')
                ->nullable();

            $table->timestamps();

            $table->index('captured_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames');
    }
};
