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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('reservation_datetime');
            $table->dateTime('visit_time');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('staff_id');
            $table->string('status');  // ステータスは文字列として扱います。必要に応じてデータ型を調整してください。
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
