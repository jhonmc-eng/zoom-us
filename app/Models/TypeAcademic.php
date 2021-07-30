<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAcademic extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'type_academic';

    protected $fillable = [
        'id',
        'name',
        'state_delete',
        'syslog'
    ];
}
