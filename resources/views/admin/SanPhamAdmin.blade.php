@extends('layout.blank')
@section('css')
    <!-- CSS SẢN PHẨM-->
    <link rel="stylesheet" href="{{ asset('css/admin/Manage.css') }}">
@endsection

@section('admin')
    <div class="container">
        <div class="header">
            <a href="{{ route('admin.addProduct') }}" class="create-button">
                <span class="icon">+</span> Tạo mới
            </a>
        </div>

        <table class="product-table">
            <thead class="the">
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá Gốc</th>
                    <th>Giá Giảm</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Loại Sản Phẩm</th>
                    <th>Loại</th>
                    <th>Tag</th>
                    <th>Trạng thái</th>
                    <th>Thương Hiệu</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dssanpham as $dssanpham)
                    <tr>
                        <td>{{ $dssanpham->id }}</td>
                        <td>{{ $dssanpham->name }}</td>
                        <td>{{ $dssanpham->price }}</td>
                        <td>{{ $dssanpham->discount_price }}</td>
                        <td>{{ $dssanpham->description }}</td>
                        <td>{{ $dssanpham->image }}</td>
                        <td>{{ $dssanpham->category_id }}</td>
                        <td>{{ $dssanpham->loai }}</td>
                        <td>{{ $dssanpham->tags }}</td>
                        <td>{{ $dssanpham->status }}</td>
                        <td>{{ $dssanpham->brand_id }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-button edit-btn">✏️</button>
                                <button class="action-button delete-btn">🗑️</button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
