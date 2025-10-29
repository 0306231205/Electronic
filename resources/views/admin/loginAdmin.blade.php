<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset("css/admin/loginAdmin.css")}}">
 
</head>
<body>
<div class="container login-container">
  <h2 class="text-center">Đăng nhập tài khoản</h2>
   <form  action={{route("admin.login.post")}} method="POST"> 
    @csrf
  <div class="mb-3">
    <label class="form-label">Tên tài khoản</label>
    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value={{old("username")}} >
    @error("username")
      <span class="text text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="mb-3">
    <label class="form-label">Mật khẩu</label>
    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror">
     @error("password")
      <span class="text text-danger">{{$message}}</span>
    @enderror
  </div>
  @if(session('status'))
    <div class="alert alert-danger">
      {{session('status')}}
    </div>
     @endif
  <button type="submit" class="btn btn-primary mt-3">Đăng nhập</button>
</form>
     
</div>
  
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>
