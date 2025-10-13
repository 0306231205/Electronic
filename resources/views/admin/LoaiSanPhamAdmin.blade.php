@extends('layout.blank')
@section('css')
    <!-- CSS SẢN PHẨM-->
    <link rel="stylesheet" href="{{ asset('css/admin/Manage.css') }}">
@endsection
@section('admin')
    <div class="container">
        <div class="header">
            <button class="create-button">
                <span class="icon">+</span> Tạo mới
            </button>
        </div>

        <table class="product-table">
            <thead class="the">
                <tr>
                    <th>ID</th>
                    <th>Tên Loại Sản Phẩm</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsLoaisanpham as $ds)
                    <tr>
                        <td>{{ $ds->id }}</td>
                        <td>{{ $ds->name }}</td>
                        <td>{{ $ds->status }}</td>
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
