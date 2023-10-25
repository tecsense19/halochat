

@include('front.layout.front')
@include('front.layout.header')
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
 
  <main id="main">

    <section class="own_ai_section">
      <div class="own_ai_container">
          <div class="own_ai_box">
            <div class="row">
              <div class="col col-md-5 col-xl-6">
                <div class="own_ai_txt">
                  <h2 class="d-none d-md-block">Create your own <span>AI Girlfriend</span></h2>
                  <h2 class="d-block d-md-none">Craft Your Perfect <br> <span>AI Girlfriend</span></h2>
                  <p>Your dream companion awaits! Create your Virtual Girlfriend, shape her look, personality, relationship, and bring her to life in one click. 100% powered by Artificial Intelligence.</p>
                  <a href="#" class="ai_btn"><img src="{{ URL::asset('public/front/img/magic-wand.svg') }}"> Create your AI</a>
                </div>
              </div>
              <div class="col col-md-7 col-xl-6">
                <div class="own_ai_img">
                  <img src="{{ URL::asset('public/front/img/red-cross-aee.svg') }}" class="red-cross-aee">
                  <svg xmlns="http://www.w3.org/2000/svg" width="528" height="313" viewBox="0 0 528 313" fill="none">
                    <path opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M146.667 117.333C146.667 52.5319 199.199 0 264 0C328.801 0 381.333 52.5319 381.333 117.333V146.667H410.667C475.468 146.667 528 199.199 528 264C528 328.801 475.468 381.333 410.667 381.333H381.333V410.667C381.333 475.468 328.801 528 264 528C199.199 528 146.667 475.468 146.667 410.667V381.333H117.333C52.5319 381.333 0 328.801 0 264C0 199.199 52.5319 146.667 117.333 146.667H146.667V117.333ZM139.333 267.667C186.775 278.896 249.983 347.563 264 403.333C278.017 347.563 341.225 278.896 388.667 267.667C341.225 256.437 278.017 187.77 264 132C249.983 187.77 186.775 256.437 139.333 267.667Z" fill="url(#paint0_radial_6435_61112)"></path>
                    <defs>
                      <radialGradient id="paint0_radial_6435_61112" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(264 264) rotate(90) scale(264)">
                        <stop stop-color="white"></stop>
                        <stop offset="0.457376" stop-color="white" stop-opacity="0.991115"></stop>
                        <stop offset="1" stop-color="#131313"></stop>
                      </radialGradient>
                    </defs>
                  </svg>
                  <img class="Girlfriend" src="{{ URL::asset('public/front/img/cma-banner.png') }}">
                </div>
              </div>
            </div>
            <div class="own_ai_img_bg"></div>
          </div>
      </div>
    </section>


    <!-- Explore AI Characters -->
    <section class="explore_ai_characters">
      <div class="container">
        <div class="explore_ai_title">
          <h2><span>Explore</span> AI Characters</h2>
        </div>
        <div class="explore_tabs">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All Models</li>
                <li data-filter=".filter-app" class="">Realistic</li>
                <li data-filter=".filter-card" class="">Anime</li>
              </ul>
            </div>
          </div>
  
          <div class="row portfolio-container">
            <!-- <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/1.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/1-1.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Alexis Ivyedge </h3>
                    <span> 25 years</span>
                    <p>Digital muse and trendsetter, known as the perfect girl next door, finds herself in a cozy local coffee shop she frequents</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/2.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/2-2.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Naomi Carter </h3>
                    <span> 31 years</span>
                    <p>Materialistic daddy's princess looking meeting new people</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div> -->
    @foreach ($profileList as $item)
    @php 
      $imgUrl = isset($item->profileImages[0]['image_path']) ? asset('storage/app/public').'/'.$item->profileImages[0]['image_path'] : ''; 
      $imgUrl2 = isset($item->profileImages[1]) ? asset('storage/app/public').'/'.$item->profileImages[1]['image_path'] : ''; 
  @endphp
            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="{{ route('front.chat.message', ['id' => $item->profile_id]) }}">
                  <div>
                    <img src="{{ $imgUrl }}" class="img-fluid">
                    <img src="{{ $imgUrl2 }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> {{ $item->name }} </h3>
                    <span> {{ $item->age }} years</span>
                    <p>{{ $item->description }}</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>
    @endforeach
            <!-- <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/4.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/4-4.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3>Bianca Moretti</h3>
                    <span> 24 years</span>
                    <p>Lifestyle influencer just coming back from her last trip.</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/5.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/5-5.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Anastasia Petrova </h3>
                    <span> 29 years</span>
                    <p>Extraverted and open minded yoga teacher</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/6.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/6-6.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Mei Ishikawa </h3>
                    <span> 24 years</span>
                    <p>Shy young woman from Japan working as a scientist</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/7.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/7-7.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Emily Caldwell </h3>
                    <span> 20 years</span>
                    <p>Young law school student, you can call her Emy</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/8.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/8-8.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Amaya Nkosi </h3>
                    <span> 36 years</span>
                    <p>Dominant housewife living in a calm and boring neighborhood</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/9.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/9-9.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Ashley White </h3>
                    <span> 22 years</span>
                    <p>Student during the week, clubber on the weekends, always open to new experiences</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/10.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/10-10.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Emi Kagawa </h3>
                    <span> 18 years</span>
                    <p>Emi, a shy 18-year-old Japanese schoolgirl, embodies her family's traditions and works hard to succeed at School.</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/11.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/11-11.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <a href="#">
                      <h3> Madison Roberts </h3>
                      <span> 21 years</span>
                      <p>Brunette student and cheerleader, passionate about sports and her well-being</p>
                    </a>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/12.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/12-12.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Katrin Schmidt </h3>
                    <span> 32 years</span>
                    <p>Strict and disciplinarian history teacher at university</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>
            
            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/13.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/13-13.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Amy Harrison </h3>
                    <span> 22 years</span>
                    <p>Empathetic 22-year-old nurse dedicated to work, and others</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/14.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/14-14.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Elise Dubois </h3>
                    <span> 27 years</span>
                    <p>Classy and confident fashion model focused on her career</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/15.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/15-15.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Sophia Martel </h3>
                    <span> 22 years</span>
                    <p>From the heart of Canada's countryside. Isolated between forests, lakes, and rivers, Sophia thrives in her wooden log house.</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 portfolio-item filter-card">
              <div class="portfolio-wrap">
                <a href="#">
                  <div>
                    <img src="{{ URL::asset('public/front/img/16.webp') }}" class="img-fluid">
                    <img src="{{ URL::asset('public/front/img/16-16.webp') }}" class="img-fluid hover_img">
                  </div>
                  <div class="portfolio-info">
                    <h3> Rina Berisha </h3>
                    <span> 23 years</span>
                    <p>Elegant Albanian from a wealthy family. She's well-educated, enjoys the luxury of life and seeks meaningful connections.</p>
                  </div>
                  <div class="chat_icon">
                    <span><img src="{{ URL::asset('public/front/img/chat-profile.svg') }}"></span>
                  </div>
                </a>
              </div>
            </div> -->
  
          </div>
        </div>
      </div>
    </section>
    <!--End Explore AI Characters -->

  </main><!-- End #main -->
  @include('front.layout.footer')