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
    Schema::create('Enquire', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('category');
        $table->string('service');
        $table->string('service_name');
        $table->date('date');
        $table->int('time');
        $table->Time('service_start_time');
        $table->Time('service_end_time');
        $table->text('message');
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('Enquire');
    }
};
