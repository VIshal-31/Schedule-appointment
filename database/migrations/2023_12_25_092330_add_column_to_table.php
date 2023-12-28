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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('Address')->nullable(false); // Adding a new column that is not nullable
            // You can use other column types and options as needed
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            
        });
    }
};
