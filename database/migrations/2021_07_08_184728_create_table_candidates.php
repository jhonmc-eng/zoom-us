<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateTableCandidates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('document')->unique();
            $table->foreignId('type_document')->constrained('type_documents');
            $table->string('ruc')->unique()->nullable();;
            $table->string('names');
            $table->string('lastname_patern');
            $table->string('lastname_matern');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('file_dni_path')->nullable();
            $table->foreignId('gender_id')->constrained('genders')->nullable();
            $table->foreignId('status_civil_id')->constrained('status_civil')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('nationality_id')->constrained('nationalitys')->nullable();
            $table->foreignId('departament_birth_id')->constrained('departaments')->nullable();
            $table->foreignId('province_birth_id')->constrained('provinces')->nullable();
            $table->foreignId('district_birth_id')->constrained('districts')->nullable();
            $table->date('date_birth')->nullable();
            $table->foreignId('departament_address_id')->constrained('departaments')->nullable();
            $table->foreignId('province_address_id')->constrained('provinces')->nullable();
            $table->foreignId('district_address_id')->constrained('districts')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('address_number')->nullable();
            $table->foreignId('pension_id')->constrained('pensions')->nullable();
            $table->foreignId('type_pension_id')->constrained('type_pensions')->nullable();
            $table->boolean('license_FA')->nullable();
            $table->string('license_path')->nullable();
            $table->boolean('discapacity_state')->nullable();
            $table->foreignId('type_discapacity_id')->constrained('type_discapacity')->nullable();
            $table->string('discapacity_file_path')->nullable();
            $table->boolean('license_driver')->nullable();
            $table->string('license_driver_path')->nullable();
            $table->boolean('consanguinity')->nullable();
            $table->text('description')->nullable();
            $table->string('photo_perfil_path')->nullable();
            $table->boolean('state_activate')->default(0);
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
        Schema::dropIfExists('candidates');
    }
}
