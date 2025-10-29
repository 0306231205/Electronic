@extends('layout.blank')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/addProduct.css') }}">
@endsection
@section('admin')

    <form action="{{ route('admin.addsanpham') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Thêm sản phẩm mới</h2>
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" required>

        @error("name")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label>Giá:</label><br>
        <input type="number" name="price"  required>
          @error("price")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label>Giá giảm:</label><br>
        <input type="number" name="discount_price" required>
          @error("discount_price")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label>Mô tả:</label><br>
        <textarea name="description"></textarea>
         @error("description")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label for="image">Hình ảnh:</label><br>
        <input type="file" id="image" name="image">
         @error("image")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label for="category">Loại Sản Phẩm:</label><br>
        <select name="category"  required>
            <option value="" selected>-- Chọn Loại Sản Phẩm ---</option>
            @foreach ($categories as $category)
                <option value={{$category->id}}>{{$category->name}}</option>
            @endforeach
        </select>
          @error("category")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label>Tag:</label><br>
        <input type="text" name="tag">
         @error("tag")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>
        <label for="type">Loại:</label><br>
        <input type="number" id="type" name="type" required>
          @error("type")
            <span class="text text-danger" >{{$message}}</span>
        @enderror
        <br>

        {{-- <label>Danh mục:</label><br>
        <select id="category_id" name="category_id"></select><br><br> --}}


        <label for="status">Trạng Thái:</label><br>
        <select name="status">
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
        <br><br>
        <label for="brand">Thương Hiệu:</label><br>
        <select name="brand">
            @foreach ($brands as $brand)
                <option value={{$brand->id}}>{{$brand->name}}</option>
            @endforeach
        </select>
        <br><br>

        <label for="supplier">Nhà Cung Cấp:</label><br>
        <select name="supplier" >
            @foreach ($suppliers as $supplier)
                <option value={{$supplier->id}}>{{$supplier->name}}</option>
            @endforeach
        </select>
        <br><br>
        <div class="button-group">
            <button type="submit" class="btn btn-add">
                Thêm sản phẩm
            </button>
            <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('admin.sanpham') }}'">
                Hủy
            </button>
        </div>

    </form>
@endsection

@section("js")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(function() {
            $.ajax({
                url: '/admin/categories',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let dropdown = $('#category_id');
                    dropdown.append('<option value="">-- Chọn danh mục --</option>');
                    $.each(data, function(_, category) {
                        dropdown.append('<option value="' + category.id + '">' + category.name + '</option>');
                    });
                }
            });
        });
    </script> --}}
@endsection

</html>
