<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class Academics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('academics', function(Blueprint $table){
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->foreignId('type_academic_id')->constrained('type_academic');
            $table->foreignId('education_level_id')->constrained('education_level');
            $table->string('study_center');
            $table->string('career');
            $table->boolean('tuition_state');
            $table->integer('tuition_number');
            $table->string('tuition_file_path');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('certificate_file_path');
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
