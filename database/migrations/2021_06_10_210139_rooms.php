<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rooms', function(Blueprint $table){
            $table->id();
            $table->string('room_name')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->string('room_email');
            $table->string('room_password');
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
        Schema::dropIfExists('rooms');
    }
}
