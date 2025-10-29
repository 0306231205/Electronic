<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
   public static function listCategories()
   {
    return self::all();
   }
   
}
