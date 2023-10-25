

   <!-- ======= Header ======= -->
   <header id="header" class="d-block d-lg-none">
    <div class="d-flex flex-xl-column flex-lg-row justify-content-center">
      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#" class="nav-link scrollto active"><img src="{{ URL::asset('public/front/img/explore.svg') }}"> <span>Explore</span></a></li>
          <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/chat.svg') }}"> <span>Chat</span></a></li>
          <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/gallery.svg') }}"> <span>Gallery</span></a></li>
          <!-- <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/magic-wand.svg') }}"> <span>Create</span></a></li>
          <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/love-lady.svg') }}"> <span>My Ai</span></a></li> -->
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->
   <!-- ======= Header ======= -->
 <header id="header">
    <div class="d-flex flex-xl-column flex-lg-row justify-content-center">
      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="{{ route('front.dashboard') }}" class="nav-link scrollto active"><img src="{{ URL::asset('public/front/img/explore.svg') }}"> <span>Explore</span></a></li>
          <li><a href="{{ route('front.chat.chat') }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/chat.svg') }}"> <span>Chat</span></a></li>
          <li><a href="{{ route('front.subscription.subscription') }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/gallery.svg') }}"> <span>Gallery</span></a></li>
          <!-- <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/magic-wand.svg') }}"> <span>Create</span></a></li>
          <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/love-lady.svg') }}"> <span>My Ai</span></a></li> -->
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->
  
  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs_top">
    <div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
    <div class="logo">
        <a href="#"><img src="{{ URL::asset('public/front/img/halochat.ai.png') }}"></a>
    </div>
    <ul>
        @if(auth()->check() || session()->has('authenticated_user'))
            <!-- User is logged in or session variable is set, display something else -->
            <!-- Add your authenticated user content here -->
            <li><a href="{{ route('front.logout') }}" class="login_btn">Logout</a></li>

        @else
            <!-- User is not logged in, display the register and login links -->
            <li><a href="{{ route('front.register') }}" class="register_btn">Register</a></li>
            <li><a href="{{ route('front.login') }}" class="login_btn">Login</a></li>
        @endif
    </ul>
</div>


    </div>
  </section><!-- End Breadcrumbs -->