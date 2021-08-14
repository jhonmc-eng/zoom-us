<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDocument extends Model
{
    use HasFactory;
    public $timestamps = TRUE;

    protected $table = 'other_documents';

    protected $fillable = [
        'id',
        'candidate_id',
        'title',
        'institution',
        'date_emition',
        'certificate_file_path',
        'state_delete',
        'syslog'
    ];

    protected $hidden = [
        'syslog',
        'updated_at',
        'created_at'
    ];
}

