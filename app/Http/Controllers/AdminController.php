<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
        $dssanpham = DB::table('products')->get();

        return view('admin.SanPhamAdmin', ['dssanpham' => $dssanpham]);
    }

    public function NhaCungCap()
    {
        $dsNhacungcap = DB::table('suppliers')->get();

        return view('admin.NhaCungCapAdmin', ['dsNhacungcap' => $dsNhacungcap]);
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
        $category=DB::table('categories')->select('id','name')->get();
        $suppliers=DB::table('suppliers')->select('id','name')->get();
        $brands=DB::table('brands')->select('id','name')->get();
        return view('admin.addProduct',['categories'=>$category,'suppliers'=>$suppliers,'brands'=>$brands]);
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

    //Controller xóa sản phẩm
    public function XoaSanPham($id)
    {
        // Tìm sản phẩm theo ID
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->route('admin.sanpham')->with('error', 'Sản phẩm không tồn tại');
        }

        // Nếu có ảnh thì xóa khỏi storage
        if (!empty($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.sanpham')->with('status', 'Xóa sản phẩm thành công');
    }
}
