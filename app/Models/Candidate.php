<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';
    public $timestamps = TRUE;

    protected $fillable = [
        'id',
        'dni',
        'ruc',
        'names',
        'lastname_patern',
        'lastname_matern',
        'email',
        'password',
        'gender_id',
        'status_civil_id',
        'phone',
        'nationality_id',
        'departament_birth_id',
        'province_birth_id',
        'district_birth_id',
        'date_birth',
        'departament_address_id',
        'province_address_id',
        'district_address_id',
        'address_one',
        'address_two',
        'address_number',
        'pension_id',
        'type_pension_id',
        'license_FA',
        'license_path',
        'discapacity_state',
        'type_discapacity_id',
        'discapacity_file_path',
        'license_driver',
        'license_driver_path',
        'consanguinity',
        'description',
        'photo_perfil_path',
        'state_delete',
        'syslog'
    ];
}
