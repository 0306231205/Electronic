<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\DB;

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
        if (! $user) {
            return redirect()->route('admin.login')->with('status', 'Username hoặc password không đúng');
        }
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
        $dsLoaisanpham = Categories::listCategories();

        return view('admin.LoaiSanPhamAdmin', ['dsLoaisanpham' => $dsLoaisanpham]);
    }

    public function NguoiDung()
    {
        $dsNguoiDung = Users::listUsers();

        return view('admin.NguoiDungAdmin', ['dsNguoiDung' => $dsNguoiDung]);
    }

    public function AddProduct()
    {
        $category = DB::table('categories')->select('id', 'name')->get();
        $suppliers = DB::table('suppliers')->select('id', 'name')->get();
        $brands = DB::table('brands')->select('id', 'name')->get();

        return view('admin.addProduct', ['categories' => $category, 'suppliers' => $suppliers, 'brands' => $brands]);
    }

    public function ThemSanPham(AddProductRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'price' => $validated['price'] ?? 0,
            'discount_price' => $validated['discount_price'] ?? 0,
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'loai' => $validated['type'],
            'image' => $imagePath ?? null,
            'brand_id' => $validated['brand'],
            'tags' => $validated['tag'] ?? null,
            'status' => $validated['status'] ?? 1,
            'supplier_id' => $validated['supplier'] ?? null,
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

    // Controller xóa sản phẩm
    public function XoaSanPham($id)
    {
        // Tìm sản phẩm theo ID
        $product = DB::table('products')->where('id', $id)->first();

        if (! $product) {
            return redirect()->route('admin.sanpham')->with('error', 'Sản phẩm không tồn tại');
        }

        // Nếu có ảnh thì xóa khỏi storage
        if (! empty($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.sanpham')->with('status', 'Xóa sản phẩm thành công');
    }
}
