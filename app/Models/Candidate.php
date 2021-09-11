<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';
    public $timestamps = TRUE;

    protected $fillable = [
        'id',
        'document',
        'type_document',
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
        'state_activate',
        'state_delete',
        'syslog'
    ];

    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at',
        'password'
    ];

    public function type_document_id(){
        return $this->hasOne('App\Models\TypeDocument','id','type_document')->select('id', 'name', 'description');
    }

    public function gender($id){
        return DB::table('genders')->where('id', $id)->first();
    }

    public function status_civil(){
        return $this->hasOne('App\Models\StatusCivil','id','status_civil_id')->select('id', 'name');
    }

    public function nationality(){
        return $this->hasOne('App\Models\Nationality','id','nationality_id')->select('id', 'name');
    }

    public function pension(){
        return $this->hasOne('App\Models\Pension','id','pension_id')->select('id', 'name');
    }

    public function type_pension(){
        return $this->hasOne('App\Models\TypePension','id','type_pension_id')->select('id', 'name');
    }

    public function type_discapacity(){
        return $this->hasOne('App\Models\TypeDiscapacity', 'id', 'type_discapacity_id');
    }

    public function ubigeo($query){
        return $query->each(function($item){
            $item->departament_birth_id = $this->departament($item->departament_birth_id);
        });
    }

    public function departament($id){
        return Departament::select('name')->where('id', $id)->first();
    }

    public function province($id){
        return Province::select('name')->where('id', $id)->first();
    }

    public function district($id){
        return District::select('name')->where('id', $id)->first();
    }
}
