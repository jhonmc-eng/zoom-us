<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    
    public $timestamps = TRUE;

    protected $table = 'jobs';

    protected $fillable = [
        'id',
        'title',
        'modality_id',
        'number_jobs',
        'date_publication',
        'date_postulation',
        'state_job_id',
        'bases',
        'schedule',
        'profile',
        'description',
        'functions',
        'requirements',
        'state_delete',
        'syslog'
    ];
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
    public function modality(){
        return $this->hasOne('App\Models\Modality', 'id', 'modality_id');
    }

    public function stateJob(){
        return $this->hasOne('App\Models\StateJob', 'id', 'state_job_id')->select('id','description','name');
    }

    public function results(){
        return $this->hasMany('App\Models\JobResult', 'job_id', 'id');
    }

    public function oficineCas(){
        return $this->hasOne('App\Models\JobOficine', 'job_id', 'id')->select('job_id','oficine_id');
    }
    
    public function oficinePractices(){
        return $this->hasMany('App\Models\JobOficine', 'job_id', 'id');
    }

    public function oficine($id){
        return Oficine::where('id', $id)->select('name', 'siglas')->first();
    }

    public function candidates($id){
        return Postulation::where([['state_delete', 0], ['job_id', $id]])->count();
    }
}

