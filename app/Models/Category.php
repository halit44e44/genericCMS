<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
    // use HasTranslations;
    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = [
      'parent_id',
       'title', 
       'description', 
      //  'imgUrl',
       'status'
    ];
    // public $translatable = ['title', 'description',];
}
