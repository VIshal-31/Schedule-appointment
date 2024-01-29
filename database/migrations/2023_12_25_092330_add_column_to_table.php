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
        // Check if 'Address' column doesn't exist before adding
        if (!Schema::hasColumn('posts', 'Address')) {
            $table->string('Address')->nullable();
        }
    });
}


    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            
        });
    }
};
