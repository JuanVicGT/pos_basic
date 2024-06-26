<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('year')->nullable();
            $table->string('month')->nullable();

            $table->float('advance_salary')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('salary')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_salaries');
    }
};
