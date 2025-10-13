<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin/addProduct.css') }}">
</head>

<body>
    {{-- enctype để upload hình ảnh --}}
    <form action="/admin/addsanpham" method="post" enctype="multipart/form-data">
        @csrf
        <h2>Thêm sản phẩm mới</h2>

        <label for="name">Tên sản phẩm:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Giá:</label><br>
        <input type="number" id="price" name="price" required><br><br>
        <label for="discount_price">Giá Giảm:</label><br>
        <input type="number" id="discount_price" name="discount_price" required><br><br>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <label for="image">Hình ảnh:</label><br>
        <input type="file" id="image" name="image"><br><br>

        <label for="category">Loại Sản Phẩm:</label><br>
        <input type="number" id="category" name="category" required><br><br>

        <label for="type">Loại:</label><br>
        <input type="number" id="type" name="type" required><br><br>

        <label for="tag">Tag:</label><br>
        <input type="text" id="tag" name="tag" required><br><br>

        <label for="status">Trạng Thái:</label><br>
        <input type="number" id="status" name="status" required><br><br>

        <label for="brand">Thương Hiệu:</label><br>
        <input type="number" id="brand" name="brand" required><br><br>

        <label for="supplier">Nhà Cung Cấp:</label><br>
        <input type="number" id="supplier" name="supplier" required><br><br>

        <div class="button-group">
            <button type="submit" class="btn btn-add">
                Thêm sản phẩm
            </button>
            <button type="button" class="btn btn-cancel" onclick="window.location.href='{{ route('admin.sanpham') }}'">
                Hủy
            </button>
        </div>

    </form>

</body>

</html>
