<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\Suppliers;
use App\Models\Users;
use App\Models\Products;

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

        $user = DB::table('users')->where('username', $request->username)->where('password', $request->password)->first();
        if (!$user) return redirect()->route('admin.login')->with('status', "Username hoặc password không đúng");
        session()->put('login', true);
        session()->put('user_role', $user->role);
        return redirect()->route('admin.index');
    }

    public function SanPham()
    {
        $dssanpham = Products::listProduct();

        return view('admin.SanPhamAdmin', ['dssanpham' => $dssanpham]);
    }

    public function NhaCungCap()
    {
        $dsNhacungcap = Suppliers::listSuppliers();

        return view('admin.NhaCungCapAdmin', ['dsNhacungcap' => $dsNhacungcap]);
    }

    public function LoaiSanPham()
    {
        $dsLoaisanpham =Categories::listCategories();

        return view('admin.LoaiSanPhamAdmin', ['dsLoaisanpham' => $dsLoaisanpham]);
    }

    public function NguoiDung()
    {
        $dsNguoiDung = Users::listUsers();

        return view('admin.NguoiDungAdmin', ['dsNguoiDung' => $dsNguoiDung]);
    }

    public function AddProduct()
    {
        return view('admin.addProduct');
    }

     public function ThemSanPham(AddProductRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'loai' => $validated['type'],
            'tags' => $validated['tag'],
            'status' => $validated['status'],
            'brand_id' => $validated['brand'],
            'supplier_id' => $validated['supplier'],
        ];

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $imagePath;
        }

        Products::insertProduct($data);

        return redirect()->route('admin.sanpham')->with('status', 'Thêm sản phẩm thành công!');
    }

    public function responeJsonCategories()
    {
        $dsDanhMuc = Categories::listCategories();
    return response()->json($dsDanhMuc);
    }
}
