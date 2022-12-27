<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
