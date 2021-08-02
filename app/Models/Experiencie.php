<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencie extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'experiencies';

    protected $fillable = [
        'id',
        'candidate_id',
        'institution',
        'boss',
        'phone',
        'charge',
        'area',
        'sector',
        'date_start',
        'date_end',
        'functions',
        'certificate_file_path',
        'state_delete',
        'syslog'
    ];
}
