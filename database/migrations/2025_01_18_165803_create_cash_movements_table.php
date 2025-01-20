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
        Schema::create('cash_movements', function (Blueprint $table) {
            $table->id();

            $table->float('amount');
            $table->float('final_amount');
            $table->text('description');
            $table->enum('type', ['in', 'out']);
            $table->date('date');
            $table->integer('month'); // Example to get the current month: Carbon::now()->month
            $table->integer('year');

            $table->float('balance')->nullable()->default(0);
            $table->string('doc_id')->nullable();
            $table->string('doc_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_movements');
    }
};
