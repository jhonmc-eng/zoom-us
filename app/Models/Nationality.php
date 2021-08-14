<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    protected $table = 'nationalitys';

    public $fillable = [
        'id',
        'name'
    ];

    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
}
