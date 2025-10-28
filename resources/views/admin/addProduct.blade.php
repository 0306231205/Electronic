<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- khai bao token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
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

        <label>Mô tả:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Hình ảnh:</label><br>
        <input type="file" name="image"><br><br>

        <label>Danh mục:</label><br>
        <select id="category_id" name="category_id"></select><br><br>

        <label>Loại:</label><br>
        <input type="number" name="type" required><br><br>

        <label>Tag:</label><br>
        <input type="text" name="tag"><br><br>

        <label>Trạng thái:</label><br>
        <input type="number" name="status" required><br><br>

        <label>Thương hiệu:</label><br>
        <input type="number" name="brand" required><br><br>

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
