<?php
use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ResultToken;
use App\Http\Middleware\IsLogin;

// Route::get('/', function () {
//     return view('welcome');
// });


//--------------------------------------------Route User-----------------------------------------------

//Router Trang Chủ
Route::get('/',[WebController::class,'index'])->name('user.index');
//Route Trang Cart
Route::get('/cart',[WebController::class,'cart']);
//Route Trang Checkout
Route::get('/checkout',[WebController::class,'checkout']);
//Route Trang Shop
Route::get('/shop',[WebController::class,'shop']);
//Route Trang Single Product
Route::get('/single-product',[WebController::class,'singleproduct']);
//Route Trang Contact
Route::get('/contact',[WebController::class,'contact']);
Route::post('/addContact',[ContactController::class,'addContact']);
//Rou Home Admin
Route::view('/admin',[AdminController::class,'admin.HomeAdmin']);
//fallback lỗi url
Route::fallback(function(){
    return "<h1>URL khong ton tai</h1>";
});
//middle ware lấy url, time , ip
Route::get('/middle', function () {

})->middleware(ResultToken::class);
//tail -f storage/logs/laravel.log
Route::get('/login',[WebController::class,'login']);
Route::get('signup',[WebController::class,'signup']);
Route::post('/login',[WebController::class,'dangNhap']);
