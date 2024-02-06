<?php

// In the migration file (e.g., create_schedule_table.php)
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->time('first_slot_start_time')->nullable();
            $table->time('first_slot_end_time')->nullable();
            $table->time('second_slot_start_time')->nullable();
            $table->time('second_slot_end_time')->nullable();
            $table->enum('activity_status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Insert default values
        $this->insertDefaultRows();
    }

    public function down()
    {
        Schema::dropIfExists('schedule');
    }

    private function insertDefaultRows()
    {
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        foreach ($days as $index => $day) {
            DB::table('schedule')->insert([
                'day' => $day,
                'id' => $index + 1,
                'first_slot_start_time' => null,
                'first_slot_end_time' => null,
                'second_slot_start_time'=> null,
                'second_slot_end_time' => null,
                'activity_status' => 'inactive' 

                
            ]);
        }
    }
}

