@extends('layout.user_layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.1.1/ckeditor5.css"><link rel="icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/96x96.png" sizes="96x96">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/120x120.png" sizes="120x120">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/152x152.png" sizes="152x152">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/167x167.png" sizes="167x167">
		<link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/180x180.png" sizes="180x180">
		<link rel="stylesheet" href="./style.css">
		<link rel="stylesheet" href="./ckeditor5/ckeditor5.css">

@endsection
@section('main')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">Liên hệ</h2>
      </div>
    </section>

    <hr class="mt-2 text-secondary " />
    <div class="mb-4 pb-4"></div>

    <section class="contact-us container">
      <div class="mw-930">
        <div class="contact-us__form">
          <form name="contact-us-form" class="needs-validation" novalidate="" method="POST" action="/addContact">
            @csrf
            <h3 class="mb-5">Thông tin liên hệ</h3>
            <div class="form-floating my-4">
              <input type="text" class="form-control " name="name" placeholder="Name *"  >
              <label for="contact_us_name">Name: *</label>
              <span class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-floating my-4">
              <input type="text" class="form-control " name="phone" placeholder="Phone *" >
              <label for="contact_us_name">Phone:*</label>
              <span class="text-danger">
                 @error('phone')
                    {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-floating my-4">
              <input type="email" class="form-control " name="email" placeholder="Email address *" >
              <label for="contact_us_name">Email: *</label>
              <span class="text-danger">
                 @error('email')
                    {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-floating my-4">
              <input type="text" class="form-control " name="title" placeholder="Title *" >
              <label for="contact_us_name">Title: *</label>
              <span class="text-danger">
                 @error('title')
                    {{ $message }}
                @enderror
              </span>
            </div>
            <div class="my-4">
              <textarea class="form-control form-control_gray " name="content" placeholder="Note" cols="100"
                rows="8"  id="editor"></textarea>
              <span class="text-danger">
                 @error('content')
                    {{ $message }}
                @enderror
              </span>
            </div>
            <div class="my-4">
              <button type="submit">Send</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
@endsection

@section('js')
<script type="importmap">
		{
			"imports": {
				"ckeditor5": "./ckeditor5/ckeditor5.js",
				"ckeditor5/": "./ckeditor5/"
			}
		}

		</script>
        <script type="module" src="./main.js"></script>
@endsection

