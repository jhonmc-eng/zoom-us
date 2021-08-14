<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    public $timestamps = TRUE;

    protected $table = 'postulations';

    protected $fillable = [
        'id',
        'job_id',
        'candidate_id',
        'oficine_id',
        'format_1_path',
        'cv_path',
        'constancia_path',
        'format_2_path',
        'rnscc_path',
        'postulation_date',
        'state_delete',
        'syslog'
    ];

    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];

    public function job(){
        return $this->hasOne('App\Models\Job', 'id', 'job_id')
                    ->select('id', 'title','number_jobs','date_postulation','date_publication','modality_id', 'state_job_id');
    }
    public function candidate(){
        return $this->hasOne('App\Models\Candidate', 'id', 'candidate_id');
    }
    public function oficine(){
        return $this->hasOne('App\Models\Oficine', 'id', 'oficine_id')->select('id','name','siglas');
    }
    public function modality($modality_id){
        return Modality::where('id', $modality_id)->select('id','name')->first();
    }
    public function state_job($id){
        return StateJob::where('id', $id)->select('name')->first();
    }
}
