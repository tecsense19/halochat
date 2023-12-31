<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>vice.app | chat and connect with AI companions</title>

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
  <style>

  </style>
</head>
<link rel="icon" href="{{ URL::asset('public/front/img/fav48x48.ico') }}" type="image/x-icon" sizes="48x48">
<link rel="icon" href="{{ URL::asset('public/front/img/fav16x16.ico') }}" type="image/x-icon" sizes="16x16">
<link rel="icon" href="{{ URL::asset('public/front/img/fav32x32.ico') }}" type="image/x-icon" sizes="32x32">
<body>
 
<section class="form_section">
  <div class="container">
    <div class="account_box">
      <div class="welcome_to_halochat">
        <h5>Welcome!</h5>
        <span>Sign up to your account</span>
      </div>
      <form action="{{ route('authenticate') }}" method="POST">
        {!! csrf_field() !!}
      <div class="form_sing_up">
          <div class="sign_in_google_btn">
          <a href="{{ route('google.login') }}"><img src="{{ URL::asset('public/front/img/connect-with-ai.png')}}"></a>
            <div class="org">
              <hr>
                <span>OR</span>
              <hr>
            </div>
          </div>

          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif

        
          <div class="contact_details">
            <input type="email" name="email" required="required" placeholder="Email">
            <img src="{{ URL::asset('public/front/img/mail_svg1.png') }}" class="lock-icon" height="18" width="18"> 
            <!-- <svg class="text-[#8D8D8D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
            </svg> -->
          </div>
          @error('email')
                <span class="text-danger">{{ $message }}</span>
          @enderror
          <div class="contact_details">
            <input type="password" name="password" id="passwordField" required="required" placeholder="Password">
            <img src="{{ URL::asset('public/front/img/eye.svg')}}" class="eye-icon" id="showPassword">
            <img src="{{ URL::asset('public/front/img/lock.svg')}}" class="lock-icon">
          </div>
          @error('password')
                            <span class="text-danger">{{ $message }}</span>
          @enderror
          <p class="forgot-password"><a href="{{ route('forgotpass') }}">Forgot your password?</a></p>
          <div class="contact_details">
            <button type="submit">Sign in</button>
            <!-- <span>By signing up, you agree to <a href="#">Terms of Service</a></span> -->
          </div>
        </form>
        <div class="account-yet">
          <p>Already have an account yet? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>
        @error('deleted')
                <span class="text-danger">{{ $message }}</span>
          @enderror
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
</body>

</html>