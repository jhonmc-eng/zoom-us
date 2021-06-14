<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

class Meetings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('meetings', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('room_id')->constrained('rooms');
            $table->dateTime('date_start');
            $table->float('meeting_duration');
            $table->foreignId('type_meet_id')->constrained('type_meets');
            $table->string('url');
            $table->string('meeting_room_id');
            $table->string('meeting_room_code');
            $table->string('theme');
            $table->text('syslog');
            $table->boolean('state_delete');
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
        //
        Schema::dropIfExists('meetings');
    }
}
