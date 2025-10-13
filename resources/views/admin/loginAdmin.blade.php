<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="{{ asset('css/admin/loginAdmin.css') }}">
</head>
<body>
  <div class="login-container">
    <h2>Đăng nhập tài khoản</h2>
    @if(session('status'))
        {{session('status')}}
   @endif
    <form action="/admin/login" method="POST">
      @csrf
      <input type="text" placeholder="Nhập tài khoản *" required name="username">
      <input type="password" placeholder="Nhập mật khẩu *" required name="password">
      <button type="submit" class="btn">Đăng nhập</button>
      <ul style="list-style-position: inside">
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
        @endforeach
      </ul>

    </form>
</body>
</html>
