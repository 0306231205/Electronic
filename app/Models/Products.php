<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   protected $table = 'products';

   //--------------------------------------------Product User-----------------------------------------------
   public static function productSeller()
   {
      return self::where('loai',1)->limit(3)->get();
   }
   public static function productRecentlyView()
   {
      return self::where('loai',2)->limit(3)->get();
   }
   public static function productTopNew(){
      return self::where('loai',3)->limit(3)->get();
   }

   //--------------------------------------------Product Admin-----------------------------------------------
   public static function listProduct()
   {
      return self::all();
   }
   public static function insertProduct($data)
   {
      return self::insert($data);
   }
}
