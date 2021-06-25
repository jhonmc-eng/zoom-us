<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    use HasFactory;
    
    public $timestamps = TRUE;

    protected $table = 'modalitys';

    protected $fillable = [
        'id',
        'name',
        'description',
        'state_delete',
        'syslog'
    ];
}
