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
                    <th>Username</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Họ và Tên</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsNguoiDung as $ds)
                    <tr>
                        <td>{{ $ds->id }}</td>
                        <td>{{ $ds->username }}</td>
                        <td>{{ $ds->email }}</td>
                        <td>{{ $ds->phone }}</td>
                        <td>{{ $ds->role }}</td>
                        <td>{{ $ds->status }}</td>
                        <td>{{ $ds->name }}</td>
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
