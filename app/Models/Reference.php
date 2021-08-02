<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    public $timestamps = TRUE;

    protected $table = 'references';

    protected $fillable = [
        'id',
        'candidate_id',
        'names',
        'email',
        'charge',
        'phone',
        'institution',
        'state_delete',
        'syslog'
    ];

}
