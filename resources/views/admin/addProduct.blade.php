<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
    <title>Thêm sản phẩm</title>
=======
    {{-- khai bao token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
>>>>>>> origin/LoadCategories/FixAddProduct
    <link rel="stylesheet" href="{{ asset('css/admin/addProduct.css') }}">
</head>
<body>
    <form action="{{ route('admin.addsanpham') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Thêm sản phẩm mới</h2>

        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Giá:</label><br>
        <input type="number" name="price" required><br><br>

        <label>Giá giảm:</label><br>
        <input type="number" name="discount_price"><br><br>

        <label for="category">Loại Sản Phẩm:</label><br>

        <select name="category" >
            @foreach ($categories as $category)
                <option value={{$category->id}}>{{$category->name}}</option>
            @endforeach
        </select>
        <label for="type">Loại:</label><br>
        <input type="number" id="type" name="type" required><br><br>

        <label>Danh mục:</label><br>
        <select id="category_id" name="category_id"></select><br><br>

        <label for="status">Trạng Thái:</label><br>
        <select name="status">
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
        <label for="brand">Thương Hiệu:</label><br>
        <select name="brand">
            @foreach ($brands as $brand)
                <option value={{$brand->id}}>{{$brand->name}}</option>
            @endforeach
        </select>
        <label for="supplier">Nhà Cung Cấp:</label><br>
        <select name="supplier" >
            @foreach ($suppliers as $supplier)
                <option value={{$supplier->id}}>{{$supplier->name}}</option>
            @endforeach
        </select>
        <div class="button-group">
            <button type="submit" class="btn btn-add">
                Thêm sản phẩm
            </button>
            <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('admin.sanpham') }}'">
                Hủy
            </button>
        </div>

        <label>Nhà cung cấp:</label><br>
        <input type="number" name="supplier" required><br><br>

        <button type="submit">Thêm sản phẩm</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
    </script>
</body>
</html>
