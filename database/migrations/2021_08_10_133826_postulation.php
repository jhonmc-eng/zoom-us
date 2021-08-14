<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Postulation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('candidate_id')->constrained('candidates');
            $table->foreignId('oficine_id')->constrained('oficines');
            $table->string('format_1_path');
            $table->string('cv_path');
            $table->string('constancia_path')->nullable();
            $table->string('format_2_path');
            $table->string('rnscc_path');
            $table->date('postulation_date');
            $table->boolean('state_delete')->default(0);
            $table->text('syslog')->nullable();
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
