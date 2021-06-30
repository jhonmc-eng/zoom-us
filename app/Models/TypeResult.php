<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeResult extends Model
{
    use HasFactory;

    protected $table = 'type_results';

    protected $fillable =[
        'id',
        'name',
        'description',
        'state_delete',
    ];

    protected $hidden = [
        'syslog'
    ];
}
