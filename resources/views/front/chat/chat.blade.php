
<?php 

$user = isset($user) ? $user : '';
$name = isset($user->name) ? $user->name : '';
$description = isset($user->description) ? $user->description : '';
$personality = isset($user->personality) ? $user->personality : '';
$occupation = isset($user->occupation) ? $user->occupation : '';
$hobbies = isset($user->hobbies) ? $user->hobbies : '';
$body_description = isset($user->body_description) ? $user->body_description : '';
$ethnicity = isset($user->ethnicity) ? $user->ethnicity : '';
$age = isset($user->age) ? $user->age : '';
$relationship_status = isset($user->relationship_status) ? $user->relationship_status : '';

$profileImages = isset($user->profileImages) ? $user->profileImages : [];


?>
@include('front.layout.front')
@include('front.layout.header')

<main id="main" class="pt-0">
    <section class="position-relative">
      <div class="container-fluid g-0">
        <div class="all_details_box">
          <div class="chat-menu">
            <div class="chat-title">
              <h3>Chat</h3>
            </div>
            <form action="#" class="search-form">
              <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                  clip-rule="evenodd"></path>
              </svg>
              <input type="text" name="search" placeholder="Search...">
            </form>
            @php 
                    $imgUrl1 = isset($user->profileImages[0]['image_path']) ? asset('storage/app/public').'/'.$user->profileImages[0]['image_path'] : ''; 
            @endphp
            <a href="#">
              <div class="chat-admin">
                <div class="chat-profile">
                  <img src="{{ $imgUrl1 }}">
                </div>
                <div class="admin_deatail">
                  <h6>{{ $name }}</h6>
                  <p>Hey there… have we met before?</p>
                </div>
                <div class="chat_delete">
                  <p>04:42</p>
                  <p>
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg">
                      <g id="Group">
                        <path id="Vector"
                          d="M2.42742 7.17755C2.88001 4.10191 5.7402 1.97552 8.81583 2.42811C9.86518 2.58252 10.8495 3.03026 11.6555 3.71977L10.93 4.44532C10.6868 4.68857 10.6868 5.08292 10.9301 5.3261C11.0469 5.44282 11.2052 5.50842 11.3703 5.50845H14.2265C14.5704 5.50845 14.8493 5.22962 14.8493 4.88565V2.02947C14.8492 1.68551 14.5703 1.40673 14.2263 1.40679C14.0612 1.40682 13.9029 1.47242 13.7862 1.58914L12.9765 2.39877C9.88891 -0.353483 5.1548 -0.0816883 2.40255 3.00586C1.4275 4.09967 0.794753 5.45549 0.582688 6.90538C0.499077 7.41939 0.847973 7.90386 1.36196 7.98748C1.40826 7.99501 1.45503 7.99907 1.50195 7.99965C1.9722 7.99457 2.36693 7.64392 2.42742 7.17755Z"
                          fill="currentColor"></path>
                        <path id="Vector_2"
                          d="M14.4957 7.99965C14.0255 8.00473 13.6307 8.35538 13.5702 8.82175C13.1176 11.8974 10.2575 14.0238 7.18182 13.5712C6.13248 13.4168 5.14812 12.9691 4.34213 12.2796L5.06769 11.554C5.31087 11.3108 5.31082 10.9164 5.06754 10.6732C4.9508 10.5565 4.79245 10.4909 4.62736 10.4909H1.77123C1.42727 10.4909 1.14844 10.7697 1.14844 11.1137V13.9699C1.14853 14.3138 1.42741 14.5926 1.77138 14.5925C1.93647 14.5925 2.09482 14.5269 2.21156 14.4102L3.0212 13.6006C6.10801 16.3531 10.8418 16.0822 13.5943 12.9953C14.5699 11.9013 15.203 10.545 15.415 9.09457C15.4989 8.58061 15.1504 8.0959 14.6364 8.01194C14.5899 8.00432 14.5429 8.0002 14.4957 7.99965Z"
                          fill="currentColor"></path>
                      </g>
                    </svg>
                    <svg width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g>
                        <path
                          d="M14.0002 3.83301H2.00016C1.82335 3.83301 1.65378 3.90325 1.52876 4.02827C1.40373 4.15329 1.3335 4.32286 1.3335 4.49967C1.3335 4.67649 1.40373 4.84605 1.52876 4.97108C1.65378 5.0961 1.82335 5.16634 2.00016 5.16634H3.3335V13.1663C3.33366 13.6967 3.54442 14.2053 3.91946 14.5804C4.2945 14.9554 4.80311 15.1662 5.3335 15.1663H10.6668C11.1972 15.1662 11.7058 14.9554 12.0809 14.5804C12.4559 14.2054 12.6667 13.6967 12.6668 13.1663V5.16634H14.0002C14.177 5.16634 14.3465 5.0961 14.4716 4.97108C14.5966 4.84605 14.6668 4.67649 14.6668 4.49967C14.6668 4.32286 14.5966 4.15329 14.4716 4.02827C14.3465 3.90325 14.177 3.83301 14.0002 3.83301ZM7.3335 11.1663C7.3335 11.3432 7.26326 11.5127 7.13823 11.6377C7.01321 11.7628 6.84364 11.833 6.66683 11.833C6.49002 11.833 6.32045 11.7628 6.19543 11.6377C6.0704 11.5127 6.00016 11.3432 6.00016 11.1663V7.83301C6.00016 7.6562 6.0704 7.48663 6.19543 7.3616C6.32045 7.23658 6.49002 7.16634 6.66683 7.16634C6.84364 7.16634 7.01321 7.23658 7.13823 7.3616C7.26326 7.48663 7.3335 7.6562 7.3335 7.83301V11.1663ZM10.0002 11.1663C10.0002 11.3432 9.92993 11.5127 9.8049 11.6377C9.67988 11.7628 9.51031 11.833 9.3335 11.833C9.15669 11.833 8.98712 11.7628 8.86209 11.6377C8.73707 11.5127 8.66683 11.3432 8.66683 11.1663V7.83301C8.66683 7.6562 8.73707 7.48663 8.86209 7.3616C8.98712 7.23658 9.15669 7.16634 9.3335 7.16634C9.51031 7.16634 9.67988 7.23658 9.8049 7.3616C9.92993 7.48663 10.0002 7.6562 10.0002 7.83301V11.1663Z"
                          fill="currentColor"></path>
                        <path
                          d="M6.66667 3.16634H9.33333C9.51014 3.16634 9.67971 3.0961 9.80474 2.97108C9.92976 2.84605 10 2.67649 10 2.49967C10 2.32286 9.92976 2.15329 9.80474 2.02827C9.67971 1.90325 9.51014 1.83301 9.33333 1.83301H6.66667C6.48986 1.83301 6.32029 1.90325 6.19526 2.02827C6.07024 2.15329 6 2.32286 6 2.49967C6 2.67649 6.07024 2.84605 6.19526 2.97108C6.32029 3.0961 6.48986 3.16634 6.66667 3.16634Z"
                          fill="currentColor"></path>
                      </g>
                    </svg>
                  </p>
                </div>
              </div>
            </a>

          </div>

          <div class="start_chat_part">
            <div id="wrapper" class="wrapper">
              <div id="content" class="content">
                <div class="chat-profile-bar">
                  <div class="asuna-saito">
                    <div class="asuna-image">
                      <img src="{{ $imgUrl1 }}">
                    </div>
                    <div class="asuna-name">
                      <h6>{{ $name }}</h6>
                    </div>
                  </div>
                  <div class="toggle-button-right">
                    <img src="{{ URL::asset('public/front/img/toggle-button.svg') }}">
                  </div>
                </div>
                <div class="chat_content">
                  <div class="row">
                    <div class="col-12">
                      <div class="have_we_met">
                        <div class="chat_content_box">
                          <p>Hey there… have we met before?</p>
                          <div class="volume">
                            <span><svg id="play-icon" width="20 " class="text-[#C14DA0]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"></path>
                            </svg></span>
                          </div>
                        </div>
                        <div class="message_feedback">
                          <a href="#"><img src="{{ URL::asset('public/front/img/thumbs-up.svg') }}"></a>
                          <a href="#"><img src="{{ URL::asset('public/front/img/thumbs-down.svg') }}"></a>
                        </div>
                      </div>
                      
                    </div>
                    <div class="col-12">
                      <div class="send_message">
                        <span>Send me a picture of you</span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="chat_content_img">
                        <img src="{{ URL::asset('public/front/img/2-2.webp') }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="searchbar-footer">
                  <ul class="suggestion">
                    <li>Suggestion: </li>
                    <li><a href="#">Hey! How's your day been?</a></li>
                  </ul>
                  <div class="type_message">
                    <form action="#">
                      <input type="text" name="message" placeholder="Type action message">
                      <div class="dropdown">
                        <a class="btn" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ URL::asset('public/front/img/ask-pic.svg') }}">  Ask <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a href="#">Show me...</a></li>
                          <li><a href="#">Send me...</a></li>
                          <li><a href="#">Send</a></li>
                          <li><a href="#">Can i see...</a></li>
                          <li><a href="#" data-bs-toggle="modal" data-bs-target="#How_to_use"><img src="{{ URL::asset('public/front/img/ask-info.svg') }}"> How to use</a></li>
                        </ul>
                      </div>
                      <button type="submit" data-bs-toggle="modal" data-bs-target="#send"><img src="{{ URL::asset('public/front/img/send-message.svg') }}"></button>
                    </form>
                  </div>
                </div>

              </div>


              <div id="aside" class="sidebar">
                <div class="sidebar_main_carousel">
                  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @foreach($profileImages as $key => $profileImages)
                        @php 
                            $imgUrl = isset($profileImages->image_path) ? asset('storage/app/public').'/'.$profileImages->image_path : ''; 
                        @endphp
                      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" >
                        <!-- <img src="{{ URL::asset('public/front/img/slider-img1.webp') }}" class="d-block w-100"> -->
                        <img src="{{ $imgUrl }}" class="d-block w-100">
                        1
                      </div>
                      @endforeach
                      <!-- <div class="carousel-item">
                        <img src="{{ URL::asset('public/front/img/slider-img2.webp') }}" class="d-block w-100">
                        <img src="{{ URL::asset('public/front/img/testimonial-img.png') }}" class="d-block w-100">
                        2
                      </div>
                      <div class="carousel-item">
                        <img src="{{ URL::asset('public/front/img/slider-img3.webp') }}" class="d-block w-100">
                        <img src="{{ URL::asset('public/front/img/testimonial-img.png') }}" class="d-block w-100">
                        3
                      </div> -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                </div>
                <div class="waitress">
                  <h5>{{ $name }}</h5>
                  <p>{{ $description }}</p>
                </div>
                <div class="attributes_box">
                  <h5>Personality Attributes:</h5>
                  <div class="d-flex flex-wrap justify-content-between">
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/personality.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>PERSONALITY</span>
                        <h6>{{ $personality }}</h6>
                      </div>
                    </div>
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/occupation.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>Occupation</span>
                        <h6>{{ $occupation }}</h6>
                      </div>
                    </div>
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/hobbies.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>HOBBIES</span>
                        <h6>{{ $hobbies }}</h6>
                      </div>
                    </div>
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/roleplay.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>RELATIONSHIP</span>
                        <h6>{{ $relationship_status }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="attributes_box">
                  <h5>Physical Attributes:</h5>
                  <div class="d-flex flex-wrap justify-content-between">
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/body.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>BODY</span>
                        <h6>{{ $body_description }}</h6>
                      </div>
                    </div>
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/age.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>AGE</span>
                        <h6>{{ $age }}</h6>
                      </div>
                    </div>
                    <div class="attributes_item">
                      <div class="attributes_icon">
                        <img src="{{ URL::asset('public/front/img/ethinicity.svg') }}">
                      </div>
                      <div class="attributes_txt">
                        <span>ETHNICITY</span>
                        <h6>{{ $ethnicity }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @include('front.layout.footer')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.toggle-button-right').on('click', function () {
        $('.sidebar').toggleClass('isClosed');
        $('.sidebar ul.nav').toggleClass('isClosed');
      });
    });
  </script>