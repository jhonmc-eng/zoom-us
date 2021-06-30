<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('job_results', function(Blueprint $table){
            $table->id();
            $table->foreignId('type_result_id')->constrained('type_results');
            $table->foreignId('job_id')->constrained('jobs');
            $table->date('date_publication');
            $table->string('path');
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
        Schema::dropIfExists('job_results');

    }
}
