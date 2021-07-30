<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'academics';

    protected $fillable = [
        'id',
        'candidate_id',
        'type_academic_id',
        'education_level_id',
        'study_center',
        'career',
        'tuition_state',
        'tuition_number',
        'tuition_file_path',
        'date_start',
        'date_end',
        'certificate_file_path',
        'state_delete',
        'syslog'
    ];

    public function education_level(){
        return $this->hasOne('App\Models\EducationLevel', 'id', 'education_level_id');
    }
    public function type_academic(){
        return $this->hasOne('App\Models\TypeAcademic', 'id', 'type_academic_id');
    }
}
