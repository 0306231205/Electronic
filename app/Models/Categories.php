<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
      protected $table = 'categories';
    protected $fillable = [
        'name',
        'status',
    ];
  
   public static function listCategories()
   {
    return self::all();
   }
   public static function insertCategories($data)
    {
        return self::create($data);
    }
    public $timestamps = false;
}
