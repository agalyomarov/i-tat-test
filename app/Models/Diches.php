<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diches extends Model
{
    public $table = 'diches';
    protected $primaryKey = 'id_diches';
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
