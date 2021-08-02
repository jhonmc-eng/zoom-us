<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Experiencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->string('institution');
            $table->string('boss');
            $table->string('phone');
            $table->string('charge');
            $table->string('area');
            $table->string('sector');
            $table->date('date_start');
            $table->date('date_end');
            $table->text('functions');
            $table->string('certificate_file_path')->nullable();
            $table->boolean('state_delete')->default(0);
            $table->text('syslog');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
    }
}
