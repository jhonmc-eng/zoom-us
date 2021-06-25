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

    public function modality(){
        return $this->hasOne('App\Models\Modality', 'id', 'modality_id');
    }

    public function stateJob(){
        return $this->hasOne('App\Models\StateJob', 'id', 'state_job_id');
    }
}

