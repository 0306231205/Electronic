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
       Products::insertProduct($data);

        return redirect()->route('admin.sanpham')->with('status', 'Thêm sản phẩm thành công');
    }
}
