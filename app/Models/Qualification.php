<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    protected $table = 'qualifications';

    protected $fillable =[
        'id',
        'candidate_id',
        'type_qualifications_id',
        'cant_hours',
        'name_institution',
        'title_course',
        'date_start',
        'date_end',
        'certificate_file_path',
        'state_delete'
    ];

    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];

    public function TypeQualification(){
        return $this->hasOne('App\Models\TypeQualification', 'id', 'type_qualifications_id');
    }
}
