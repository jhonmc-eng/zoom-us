<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('jobs', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->foreignId('modality_id')->constrained('modalitys');
            $table->integer('number_jobs');
            $table->date('date_publication');
            $table->date('date_postulation');
            $table->foreignId('state_job_id')->constrained('states_jobs');
            $table->string('bases');
            $table->string('schedule');
            $table->string('profile');
            $table->text('description');
            $table->text('functions');
            $table->text('requirements');
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
        Schema::dropIfExists('jobs');
    }
}
