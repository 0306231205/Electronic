<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- khai bao token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin/addProduct.css') }}">
</head>

<body class="p-4">

    <form action="{{ route('admin.addsanpham') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="mb-4">Thêm sản phẩm mới</h2>

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá:</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá giảm:</label>
            <input type="number" name="discount_price" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục:</label>
            <div class="d-flex gap-2">
                <select id="category_id" name="category_id" class="form-select w-50"></select>
                <button type="button" style="height: 45px ; width:200px" class="btn btn-outline-primary "
                    data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    + Thêm Danh Mục
                </button>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại:</label>
            <input type="number" name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tag:</label>
            <input type="text" name="tag" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <input type="number" name="status" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thương hiệu:</label>
            <input type="number" name="brand" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nhà cung cấp:</label>
            <input type="number" name="supplier" class="form-control" required>
        </div>

        <button type="submit">Thêm sản phẩm</button>
    </form>

    <!-- Modal Thêm Danh Mục -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm Loại Sản Phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục:</label>
                        <input type="text" id="categoryName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái:</label>
                        <select id="categoryStatus" class="form-select">
                            <option value="1" selected>Hoạt Động</option>
                            <option value="0">Không Hoạt Động</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveCategory" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(function() {
            // Load danh mục bằng ajax
            $.get('/admin/categories', function(data) {
                let dropdown = $('#category_id');
                dropdown.empty().append('<option value="">-- Chọn danh mục --</option>');
                data.forEach(cat => {
                    dropdown.append(`<option value="${cat.id}">${cat.name}</option>`);
                });
            });

            // Xử lý thêm danh mục bằng Ajax
            $('#saveCategory').click(function() {
                let name = $('#categoryName').val().trim();
                let status = $('#categoryStatus').val();

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
                        // Thêm option mới vào dropdown và chọn luôn
                        $('#category_id').append(
                            `<option value="${category.id}" selected>${category.name}</option>`
                        );
                        // Reset form modal
                        $('#categoryName').val('');
                        $('#categoryStatus').val('1');

                        // Ẩn modal
                        const modalEl = document.getElementById('addCategoryModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();

                        // Thông báo thành công
                        const alertBox = $(
                            '<div class="alert alert-success mt-3" role="alert">Đã thêm danh mục mới thành công!</div>'
                        )
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi thêm danh mục!');
                    }
                });
            });
        });
    </script>
</body>

</html>
