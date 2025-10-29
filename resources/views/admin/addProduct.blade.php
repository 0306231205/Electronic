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
        {{-- <label for="category">Loại Sản Phẩm:</label><br>
        <select name="category"  required>
            <option value="" selected>-- Chọn Loại Sản Phẩm ---</option>
            @foreach ($categories as $category)
                <option value={{$category->id}}>{{$category->name}}</option>
            @endforeach
        </select>
          @error("category")
            <span class="text text-danger" >{{$message}}</span>
        @enderror --}}
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

@endsection

@section("js")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Modal Thêm Danh Mục --}}
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

    {{-- jQuery & Bootstrap JS --}}
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
@endsection
</body>

</html>
