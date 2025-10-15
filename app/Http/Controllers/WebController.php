<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function cart(){
        return view("user.cart");
    }

    public function index(){
        /**
         *Select * from products =>DB::table('products)->get()
         *SELECT name,price =>DB::table('product)->select('name','price')->get()
          * Select * from product where name="nva" =>DB::table('products)->where('name','=','nva')->get()
          * Select * from products Limit 3 =->DB::table('products)->limt(3)->get()
         * Select * from product order by date desc => DB::table('products)->orderBy('date')
         * Select * from products where name="nva" and price=1 =>DB::table('products)->where('name','=','nva')->where('price',1)
         * Select * from products where name="nva" or price=1 =>DB::table('products)->where('name','=','nva')->orWhere('price',1)
         * DB::table('products)->insert([
         *  "name"=>'nva',
         *  "price"=>1,
         * ""
         * ]]);
         * DB::table("product")->where('id',1)->update([
         *  "name"=>'nvb',
         *   "price"=>2
         * ]);\
         *  DB::table('products')->where('id',1)->delete()
         * DB::table('products)->truncate()
         */
        $products_seller=DB::table('products')->where('loai',1)->limit(3)->get();
        $products_recently_view=DB::table('products')->where('loai',2)->limit(3)->get();
        $products_top_new=DB::table('products')->where('loai',3)->limit(3)->get();

        return view("user.index",['products_seller'=>$products_seller,'products_recently_view'=>$products_recently_view,
                        'products_top_new'=>$products_top_new
                    ]);

    }
    public function shop(){
        return view("shop");
    }

    public function contact(){
        return view("user.contact");
    }
    public function login(){
        return view('user.login');
    }
    public function signup(){
        return view('user.signup');
    }
    public function dangNhap(Request $request){
        return back()->with('status','Đăng nhập không thành công');
    }

}
