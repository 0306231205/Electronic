<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;

    }

    .login-container {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 320px;
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
    }
    input {
      width: 95%;
      padding: 7.5px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
      width: 100%;
      padding: 10px;
      background:  #1abc9c;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.5s;
    }
    .btn:hover {
       opacity: 0.75;
    }
    .social-login {
      margin: 15px 0;
    }
    .social-btn {
      display: block;
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 15px;
    }
    .register {
      margin-top: 15px;
      font-size: 14px;
    }
    .register a {
      color: #e53935;
      text-decoration: none;
    }
    .register .dk:hover{
        border-bottom: 1px solid black;
    }
    .register .tc:hover{
        border-bottom: 1px solid black;
    }
  </style>
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
