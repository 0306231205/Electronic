<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .register-container {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input, select {
      width: 95%;
      padding: 7.5px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
      width: 100%;
      padding: 10px;
      background: #1abc9c;
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
      text-align: center;
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
    .note {
      font-size: 13px;
      margin-top: 10px;
      color: #555;
    }
    .login-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
    .login-link a {
      color: #e53935;
      text-decoration: none;
    }
    .login-link .dn:hover, .tc:hover{
        border-bottom: 1px solid black;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Đăng ký tài khoản</h2>
    <form>
      <input type="text" placeholder="Nhập họ và tên *" required>
      <input type="text" placeholder="Nhập số điện thoại *" required>
      <input type="email" placeholder="Nhập email (không bắt buộc)">
      <input type="password" placeholder="Nhập mật khẩu *" required>
      <input type="password" placeholder="Nhập lại mật khẩu *" required>
      <button type="submit" class="btn">Đăng ký</button>
    </form>
    <div class="login-link">
      Bạn đã có tài khoản? <a href="/login" class="dn">Đăng nhập ngay</a> - <a href="/" class="tc">Quay lại</a>
    </div>
  </div>
</body>
</html>
