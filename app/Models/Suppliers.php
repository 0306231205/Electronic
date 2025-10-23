<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
   protected $table = 'suppliers';
   public static function listSuppliers()
   {
    return self::all();
   }

}
