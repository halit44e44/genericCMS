<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genres extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'genres';  
    protected $fillable = [
        'name'
    ];
}
