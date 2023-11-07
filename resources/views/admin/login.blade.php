<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('public/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/vendors/css/vendor.bundle.base.css') }}">
    
    <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="icon" href="{{ URL::asset('public/front/img/fav48x48.ico') }}" type="image/x-icon" sizes="48x48">
<link rel="icon" href="{{ URL::asset('public/front/img/fav16x16.ico') }}" type="image/x-icon" sizes="16x16">
<link rel="icon" href="{{ URL::asset('public/front/img/fav32x32.ico') }}" type="image/x-icon" sizes="32x32">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5 login">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form  action="{{ route('admin.authenticate') }}" method="post" >
                {!! csrf_field() !!}
                  <div class="form-group">
                    <label>Username or email *</label>
                    <input type="text" class="form-control p_input" name="email" id="email">
                  </div>
                  @if ($errors->has('email'))

									<span class="text-danger">{{ $errors->first('email') }}</span>

			            	@endif
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" class="form-control p_input" name="password" id="password">
                  </div>
                  @if ($errors->has('password'))

									<span class="text-danger">{{ $errors->first('password') }}</span>

				           @endif
                 
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                 
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ URL::asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ URL::asset('public/js/off-canvas.js') }}"></script>
    <script src="{{ URL::asset('public/js/hoverable-collapse.js') }}"></script>
    <script src="{{ URL::asset('public/js/misc.js') }}"></script>
    <script src="{{ URL::asset('public/js/settings.js') }}"></script>
    <script src="{{ URL::asset('public/js/todolist.js') }}"></script>
    <!-- endinject -->
  </body>
</html>