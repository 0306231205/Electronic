<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function LoadAdmin()
    {
        return view('admin.HomeAdmin');
    }

    public function loginPage()
    {
        return view('admin.loginAdmin');
    }

    public function login(AdminLoginRequest $request)
    {

        $user = DB::table('users')->where('username', $request->username)->count();
        if ($user == 0) {
            return redirect()->route('admin.login')->with('status', 'Username k ton tai');
        }
        $password = DB::table('users')->where('password', $request->password)->where('username', $request->username)->count();
        if ($password == 0) {
            return redirect()->route('admin.login')->with('status', 'Password sai ');
        }
        session()->put('login', true);

        return redirect()->route('admin.index');
    }

    public function SanPham()
    {
        $dssanpham = DB::table('products')->get();

        return view('admin.SanPhamAdmin', ['dssanpham' => $dssanpham]);
    }

    public function NhaCungCap()
    {
        $DsNhacungcap = DB::table('suppliers')->get();

        return view('admin.NhaCungCapAdmin', ['DsNhacungcap' => $DsNhacungcap]);
    }

    public function LoaiSanPham()
    {
        $dsLoaisanpham = DB::table('categories')->get();

        return view('admin.LoaiSanPhamAdmin', ['dsLoaisanpham' => $dsLoaisanpham]);
    }

    public function NguoiDung()
    {
        $dsNguoiDung = DB::table('users')->get();

        return view('admin.NguoiDungAdmin', ['dsNguoiDung' => $dsNguoiDung]);
    }

    public function AddProduct()
    {
        return view('admin.addProduct');
    }

    public function ThemSanPham(AddProductRequest $request)
    {
        $validate = $request->validated();
        $data = [
            'name' => $validate['name'],
            'discount_price' => $validate['discount_price'] ?? 0,
            'price' => $validate['price'] ?? 0,
            'description' => $validate['description'] ?? null,
            'category_id' => $validate['category'],
            'loai' => $validate['type'],
            'tags' => $validate['tag'] ?? null,
            'status' => $validate['status'] ?? 0,
            'brand_id' => $validate['brand'] ?? null,
            'supplier_id' => $validate['supplier'],
            'image' => $validate['image'] ?? null,
        ];
        if ($request->hasFile('image')) {
            // store('uploads', 'public') dùng để lưu file
            // file('image') là lấy file upload từ input
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $imagePath;
        }
        DB::table('products')->insert($data);

        return redirect()->route('admin.sanpham')->with('status', 'Thêm sản phẩm thành công');
    }
}
