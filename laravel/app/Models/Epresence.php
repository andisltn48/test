<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epresence extends Model
{
    use HasFactory;
    public $table = "epresence";
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
