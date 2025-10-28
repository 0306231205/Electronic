<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

   

    protected $fillable = [
        'name',
        'price',
        'discount_price',
        'description',
        'image',
        'category_id',
        'loai',
        'tags',
        'status',
        'brand_id',
        'supplier_id',
    ];

    // --------------------------------------------Product User-----------------------------------------------
    public static function productSeller()
    {
        return self::where('loai', 1)->limit(3)->get();
    }

    public static function productRecentlyView()
    {
        return self::where('loai', 2)->limit(3)->get();
    }

    public static function productTopNew()
    {
        return self::where('loai', 3)->limit(3)->get();
    }

    // --------------------------------------------Product Admin-----------------------------------------------
            //Lấy Danh Sách Sản Phẩm
    public static function listProduct()
    {
        return self::all();
    }
            //Thêm Sản Phẩm
    public static function insertProduct($data)
    {
        return self::create($data);
    }
     public $timestamps = false;
}
