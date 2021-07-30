<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'education_level';

    protected $fillable = [
        'id',
        'name',
        'state_delete',
        'syslog'
    ];
}
