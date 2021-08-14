<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOficine extends Model
{
    use HasFactory;
    protected $table = 'job_oficines';

    protected $fillable = [
        'id',
        'job_id',
        'oficine_id',
        'state_delete',
        'syslog'
    ];
    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
    public function name(){
        return $this->hasOne('App\Models\Oficine', 'id', 'oficine_id');
    }
}
