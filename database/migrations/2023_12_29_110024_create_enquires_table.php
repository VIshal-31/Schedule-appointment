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
        $table->date('date');
        $table->time('time');
        $table->text('message');
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('Enquire');
    }
};
