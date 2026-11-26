<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();
            $table->foreignId('freelancer_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('offered_price');
            $table->unsignedInteger('estimated_days');
            $table->text('proposal');
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                ->default('pending');
            $table->timestamps();

            $table->unique(['project_id', 'freelancer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
