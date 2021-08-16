<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobResult extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'job_results';

    protected $fillable = [
        'id',
        'type_result_id',
        'job_id',
        'date_publication',
        'path',
        'state_delete'
    ];
    
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
    public function typeResult(){
        return $this->hasOne('App\Models\TypeResult', 'id', 'type_result_id');
    }

    public function jobId(){
        return $this->hasOne('App\Models\Job', 'id', 'job_id');
    }
}
