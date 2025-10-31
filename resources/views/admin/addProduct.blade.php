@extends('layout.blank')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/addProduct.css') }}">
   <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('admin')
<form action="{{ route('admin.addsanpham') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>Thêm sản phẩm mới</h2>

    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name">
    @error('name')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label>Giá:</label><br>
    <input type="number" name="price">
    @error('price')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label>Giá giảm:</label><br>
    <input type="number" name="discount_price">
    @error('discount_price')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label>Mô tả:</label><br>
    <textarea name="description"></textarea>
    @error('description')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label for="image">Hình ảnh:</label><br>
    <input type="file" id="image" name="image">
    @error('image')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <div class="form-group">
        <label for="category_id">Danh mục:</label>
        <div class="form-inline">
            <select id="category_id" name="category_id" class="form-control" style="width: 50%;"></select>
            <button type="button"
                    style="height: 45px; width: 200px; margin-left: 10px;"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#addCategoryModal">
                + Thêm Danh Mục
            </button>
        </div>
    </div>

    @error('category_id')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label>Tag:</label><br>
    <input type="text" name="tag">
    @error('tag')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label for="type">Loại:</label><br>
    <input type="number" id="type" name="type">
    @error('type')
        <span class="text text-danger">{{ $message }}</span>
    @enderror
    <br>

    <label for="status">Trạng Thái:</label><br>
    <select name="status">
        <option value="1">Hoạt động</option>
        <option value="0">Không hoạt động</option>
    </select>
    <br><br>

    <label for="brand">Thương Hiệu:</label><br>
    <select name="brand">
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label for="supplier">Nhà Cung Cấp:</label><br>
    <select name="supplier">
        @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @endforeach
    </select>
    <br><br>

    <div class="button-group">
        <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.sanpham') }}'">Hủy</button>
    </div>
</form>

<!-- Modal Thêm Danh Mục -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="addCategoryModalLabel">Thêm Loại Sản Phẩm</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="categoryName">Tên danh mục:</label>
                    <input type="text" id="categoryName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="categoryStatus">Trạng thái:</label>
                    <select id="categoryStatus" class="form-control">
                        <option value="1" selected>Hoạt Động</option>
                        <option value="0">Không Hoạt Động</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="saveCategory" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
{{-- jQuery + Bootstrap 3 JS --}}


<script>
    //load Danh Sách Danh Mục
$(document).ready(function() {
    $.get('/admin/categories', function(data) {
        var dropdown = $('#category_id');
        dropdown.empty().append('<option value="">-- Chọn danh mục --</option>');
        $.each(data, function(index, cat) {
            dropdown.append('<option value="' + cat.id + '">' + cat.name + '</option>');
        });
    });
//Them Danh Muc
    $('#saveCategory').click(function() {
        var name = $('#categoryName').val().trim();
        var status = $('#categoryStatus').val();

        if (name === "") {
            alert("Vui lòng nhập tên danh mục!");
            return;
        }

        $.ajax({
            url: '/admin/categories',
            type: 'POST',
            data: {
                name: name,
                status: status,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(category) {
                $('#category_id').append(
                    '<option value="' + category.id + '" selected>' + category.name + '</option>'
                );

                $('#categoryName').val('');
                $('#categoryStatus').val('1');
                $('#addCategoryModal').modal('hide');

                $('#addCategoryModal .modal-body').prepend(
                    '<div class="alert alert-success alert-dismissible" role="alert">' +
                   
                    'Đã thêm danh mục mới thành công!' +
                    '</div>'
                );
            },
            error: function() {
                alert('Có lỗi xảy ra khi thêm danh mục!');
            }
        });
    });
});
</script>
@endsection
