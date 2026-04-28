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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('make_id')->constrained('car_makes');
            $table->foreignId('model_id')->constrained('car_models');
            $table->foreignId('fuel_type_id')->constrained('fuel_types');
            $table->foreignId('body_type_id')->constrained('body_types');
            $table->foreignId('transmission_id')->constrained('transmissions');

            $table->string('title', 128);
            $table->year('year');
            $table->unsignedInteger('price');
            $table->unsignedInteger('mileage');
            $table->decimal('engine_size', 3,1)->nullable();
            $table->unsignedSmallInteger('horsepower')->nullable();
            $table->string('color', 55)->nullable();

            $table->text('description')->nullable();
            $table->string('location', 64)->nullable();
            $table->string('slug')->unique();
            $table->boolean('featured')->default(false);

            $table->enum('status', [
                'draft',
                'active',
                'sold'
            ])->default('active');

            $table->timestamps();

            $table->softDeletes();

            // index:

            $table->index('price');
            $table->index('year');
            $table->index('mileage');
            $table->index('status');

            $table->index([
                'make_id',
                'model_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
