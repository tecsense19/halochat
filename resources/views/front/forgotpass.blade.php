<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title></title>

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

<body>

<section class="form_section">
  <div class="container">
    <div class="account_box">
      
      <div class="form_sing_up">
        <form action="{{ route('checkforgotpass') }}" method="POST">
        {!! csrf_field() !!}
        
        @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif

        <div class="welcome_to_halochat">
                  <h5>Reset Password</h5>
                  <h6 class="mb-3" style="color: rgb(163 163 163);">Enter your e-mail and we will send you the instructions to reset password</h6>
           </div>
          <div class="contact_details">
            <input type="email" name="email" required="required" placeholder="Email">
            <svg class="text-[#8D8D8D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
            </svg>
          </div>
          @error('email')
                <span class="text-danger">{{ $message }}</span>
          @enderror
          @error('emailNot')
                <span class="text-danger">{{ $message }}</span>
          @enderror

          <div class="contact_details">
            <button type="submit">Reset Password</button>
          </div>
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