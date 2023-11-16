


   <!-- ======= Header ======= -->
 <header id="header">
    <div class="d-flex flex-xl-column flex-lg-row justify-content-center">
      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="{{ route('dashboard') }}" class="nav-link scrollto active"><img src="{{ URL::asset('public/front/img/explore.svg') }}"> <span>Explore</span></a></li>
          <li><a href="{{ route('chat.chat') }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/chat.svg') }}"> <span>Chat</span></a></li>
          <li><a href="{{ route('gallery.gallery') }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/gallery.svg') }}"> <span>Gallery</span></a></li>
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
        <a href="{{ route('dashboard') }}"><img src="{{ URL::asset('public/front/img/halochat.ai.png') }}"></a>
    </div>
    <ul>
        @if(auth()->check() || session()->has('authenticated_user'))
            <!-- User is logged in or session variable is set, display something else -->
            <!-- Add your authenticated user content here -->
            
          <!-- ======= Breadcrumbs ======= -->
          <section class="breadcrumbs_top">
            <div class="container-fluid">

              <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                  <a href="{{ route('dashboard') }}"><img src="{{ URL::asset('public/front/img/halochat.ai.png') }}"></a>
                </div>
                <div class="profile_dropdown"><!--Navigation Bar Starts Here-->
                  <ul>
                    <a href="#" class="display-picture"><img src="{{ URL::asset('public/front/img/man-pur.svg') }}"> <span>My Profile</span> 
                      <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                    </svg></a><!--Profile Image-->
                    </ul>
                    <div class="card hidden"><!--ADD TOGGLE HIDDEN CLASS ATTRIBUTE HERE-->
                      <ul><!--MENU-->
                        <li><a href="{{ route('profile.index') }}"><img src="{{ URL::asset('public/front/img/settings.svg') }}"> Settings</a></li>
                        <li><a href="{{ route('gallery.gallery') }}"><img src="{{ URL::asset('public/front/img/gallery.svg') }}"> Gallery</a></li>
                        <li><a href="{{ route('subscription.subscription') }}"><img src="{{ URL::asset('public/front/img/premium-white.svg') }}"> Subscription</a></li>
                        <li><a href="#"><img src="{{ URL::asset('public/front/img/affiliate.svg') }}"> Affiliate</a></li>
                        <li><a href="{{ route('logout') }}"><img src="{{ URL::asset('public/front/img/logout.svg') }}"> Log Out</a></li>
                      </ul>
                    </div>
                </div>
              </div>

            </div>
          </section><!-- End Breadcrumbs -->
        @else
            <!-- User is not logged in, display the register and login links -->
            <li><a href="{{ route('register') }}" class="register_btn">Register</a></li>
            <li><a href="{{ route('login') }}" class="login_btn">Login</a></li>
        @endif
    </ul>
</div>


    </div>
  </section><!-- End Breadcrumbs -->

