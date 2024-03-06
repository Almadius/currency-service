<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->string('valute_id', 10);
            $table->integer('num_code');
            $table->string('char_code', 3);
            $table->integer('nominal');
            $table->string('name');
            $table->decimal('value', 10, 4);
            $table->date('date');
            $table->timestamps();

            $table->unique(['valute_id', 'date'], 'currency_date_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
