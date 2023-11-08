<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>halochat.AI | chat and connect with AI companions</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ URL::asset('public/front/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('public/front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ URL::asset('public/front/css/style.css') }}" rel="stylesheet">
</head>
<link rel="icon" href="{{ URL::asset('public/front/img/fav48x48.ico') }}" type="image/x-icon" sizes="48x48">
<link rel="icon" href="{{ URL::asset('public/front/img/fav16x16.ico') }}" type="image/x-icon" sizes="16x16">
<link rel="icon" href="{{ URL::asset('public/front/img/fav32x32.ico') }}" type="image/x-icon" sizes="32x32">
<body>

<section class="form_section">
  <div class="container">
    <div class="account_box">
      
      <div class="form_sing_up">
        <form action="{{ route('checkconfirmpass') }}" method="POST">
        {!! csrf_field() !!}
        <div class="welcome_to_halochat">
                  <h5>Create New Password</h5>
                  <h6 class="mb-3" style="color: rgb(163 163 163);">Create a new password to login</h6>
           </div>
           <div class="contact_details">
            <input type="password" name="password" id="passwordField" required="required" placeholder="Password">
            <img src="{{ URL::asset('public/front/img/eye.svg')}}" class="eye-icon" id="showPassword">
            <img src="{{ URL::asset('public/front/img/lock.svg')}}" class="lock-icon">
          </div>
          @error('password')
                <span class="text-danger">{{ $message }}</span>
          @enderror

          <div class="contact_details">
            <input type="password" name="confirm_password" id="passwordField" required="required" placeholder="Confirm password">
            <img src="{{ URL::asset('public/front/img/eye.svg')}}" class="eye-icon" id="showPassword">
            <img src="{{ URL::asset('public/front/img/lock.svg')}}" class="lock-icon">
          </div>
          @error('confirm_password')
                <span class="text-danger">{{ $message }}</span>
          @enderror

          <div class="contact_details">
            <button type="submit">Confirm</button>
          </div>
          @error('wrong')
                <span class="text-danger">{{ $message }}</span>
          @enderror
        </form>
      </div>
    </div>
  </div>
</section>

  <!-- Vendor JS Files -->
  <script src="{{ URL::asset('public/front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/aos/aos.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/typed.js/typed.umd.js') }}"></script>
  <script src="{{ URL::asset('public/front/vendor/waypoints/noframework.waypoints.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ URL::asset('public/front/js/main.js') }}"></script>


</body>

<script>
  const passwordField = document.getElementById('passwordField');
    const showPassword = document.getElementById('showPassword');

    showPassword.addEventListener('mouseover', function () {
        passwordField.type = 'text';
    });

    showPassword.addEventListener('mouseout', function () {
        passwordField.type = 'password';
});

</script>

</html>