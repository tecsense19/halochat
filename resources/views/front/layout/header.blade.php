<!-- ======= Header ======= -->
 <header id="header" class="mobile_view mobile_footerbar_hide">
    <div class="d-flex flex-xl-column flex-lg-row justify-content-center">
      
      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="{{ route('dashboard') }}" class="nav-link scrollto active"><img src="{{ URL::asset('public/front/img/compass.png') }}" width="30" height="30"> <span>Explore</span></a></li>
          @if(session('sessionprofile_id'))
          <li><a href="{{ route('chat.message', ['id' => session('sessionprofile_id') ]) }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/chatting.png') }}" width="30" height="30"> <span>Chat</span></a></li>
          @else
          <li><a href="{{ route('chat.chat') }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/chatting.png') }}" width="30" height="30"> <span>Chat</span></a></li>
          @endif
          <li><a href="{{ route('gallery.gallery') }}" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/image-gallery.png') }}" width="30" height="30"> <span>Gallery</span></a></li>
          <!-- <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/magic-wand.svg') }}"> <span>Create</span></a></li>
          <li><a href="#" class="nav-link scrollto"><img src="{{ URL::asset('public/front/img/love-lady.svg') }}"> <span>My Ai</span></a></li> -->
        </ul>
      </nav><!-- .nav-menu -->
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </div>
  </header><!-- End Header -->

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs_top">
    <div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
    <div class="logo">
        <a href="{{ route('dashboard') }}"><img src="{{ URL::asset('public/front/img/viceapp.png') }}"></a>
    </div>
    <ul>
        @if(session()->has('authenticated_user'))
            <!-- User is logged in or session variable is set, display something else -->
            <!-- Add your authenticated user content here -->
            
          <!-- ======= Breadcrumbs ======= -->
          <section class="breadcrumbs_top">
            <div class="container-fluid">

              <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                  <a href="{{ route('dashboard') }}"><img src="{{ URL::asset('public/front/img/viceapp.png') }}"></a>
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
                        <li><a href="{{ route('subscription.index') }}"><img src="{{ URL::asset('public/front/img/premium-white.svg') }}"> Subscription</a></li>
                        <li><a href="#"><img src="{{ URL::asset('public/front/img/affiliate.svg') }}"> Affiliate</a></li>
                        <li><a href="{{ route('front.logout') }}"><img src="{{ URL::asset('public/front/img/logout.svg') }}"> Log Out</a></li>
                      </ul>
                    </div>
                </div>
              </div>

            </div>
          </section><!-- End Breadcrumbs -->
        @else
            <!-- User is not logged in, display the register and login links -->
            <li><a href="{{ route('register') }}" class="register_btn"><img src="{{ URL::asset('public/front/img/edit.png') }}" width="15" height="15">&nbsp;Register</a></li>
            <li><a href="{{ route('login') }}" class="login_btn"><img src="{{ URL::asset('public/front/img/enter.png') }}" width="15" height="15">&nbsp;&nbsp;Login</a></li>
        @endif
    </ul>
</div>


    </div>
  </section><!-- End Breadcrumbs -->

