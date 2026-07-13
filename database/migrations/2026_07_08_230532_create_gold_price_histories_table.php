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
        Schema::create('gold_price_histories', function (Blueprint $table) {

            $table->id();
            $table->uuid('batch_id');

            // العيار
            $table->string('karat',10);

            // السعر
            $table->decimal('price',10,2);

            // العملة
            $table->string('currency',10)->default('SAR');

            // مصدر البيانات
            $table->string('source');

            // وقت جلب البيانات من الـ API
            $table->timestamp('fetched_at');

            // زمن الاستجابة بالمللي ثانية
            $table->integer('response_time_ms')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gold_price_histories');
    }
};
