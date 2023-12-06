<?php 
$user = isset($user) ? $user : '';
$id = isset($user->profile_id) ? $user->profile_id : '';
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
<style>
    .picture_circle {
  width: 50px; /* Set the width of the loader circle */
  height: 50px; /* Set the height of the loader circle */
  border-radius: 50%; /* Create a circular shape */
  border: 5px solid #3498db; /* Set the border color and thickness */
  border-top: 5px solid #ffffff; /* Set the color of the loader */
  animation: spin 1s linear infinite; /* Apply the rotation animation */
  border-top: 5px solid #1a1a1a !important;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

#loading-text {
  text-align: center;
  color: #B473E0; /* Set the color of the loader text */
}
</style>
@include('front.layout.front')
@include('front.layout.header')
@if ($errors->has('ai_message'))
    <script>
        // Display an alert message using JavaScript
        alert("{{ $errors->first('ai_message') }}");
    </script>
@endif
<main id="main" class="mobile_view" class="pt-0">
    <section class="position-relative">
        <div class="container-fluid g-0">
            <div class="all_details_box">
                <div class="chat-menu chat_mobile" id="chat-menu" style="display: none;">
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
                    $imgUrl1 = isset($user->profileImages[0]['image_path']) ?
                    asset('storage/app/public').'/'.$user->profileImages[0]['image_path'] : '';
                    @endphp
                    @if(!empty($getAllProfile))
                        @foreach ($getAllProfile as $chat)
                        @php
                            $imgUrl2 = isset($chat->image_path) ?
                            asset('storage/app/public').'/'.$chat->image_path : '';
                        @endphp
                    @if(session('user_id'))
                    <a href="{{ route('chat.message', ['id' => $chat->receiver_id]) }}" data-profile-id="{{ $chat->receiver_id }}" id="chatLink_{{ $chat->receiver_id }}">
                    @else
                    <a href="#" data-profile-id="{{ $chat->receiver_id }}">
                    @endif
                        <div class="chat-admin" id="mobile_view">
                            <div class="chat-profile">
                                <img src="{{ $imgUrl2 }}">

                            </div>
                            <div class="admin_deatail">
                            <h6>{{ $chat->name }}</h6>
                                <p>{{ $chat->first_message }}</p>
                            </div>
                            </a>
                            <div class="chat_delete">
                            <?php 
                            $dateString = $chat->created_at;
                            $dateTime = new DateTime($dateString);  
                            $time = $dateTime->format('H:i');
                            ?>
                            <p>{{ $time }}</p>
                                <p>
                                <!-- <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Group">
                                            <path id="Vector"
                                                d="M2.42742 7.17755C2.88001 4.10191 5.7402 1.97552 8.81583 2.42811C9.86518 2.58252 10.8495 3.03026 11.6555 3.71977L10.93 4.44532C10.6868 4.68857 10.6868 5.08292 10.9301 5.3261C11.0469 5.44282 11.2052 5.50842 11.3703 5.50845H14.2265C14.5704 5.50845 14.8493 5.22962 14.8493 4.88565V2.02947C14.8492 1.68551 14.5703 1.40673 14.2263 1.40679C14.0612 1.40682 13.9029 1.47242 13.7862 1.58914L12.9765 2.39877C9.88891 -0.353483 5.1548 -0.0816883 2.40255 3.00586C1.4275 4.09967 0.794753 5.45549 0.582688 6.90538C0.499077 7.41939 0.847973 7.90386 1.36196 7.98748C1.40826 7.99501 1.45503 7.99907 1.50195 7.99965C1.9722 7.99457 2.36693 7.64392 2.42742 7.17755Z"
                                                fill="currentColor"></path>
                                            <path id="Vector_2"
                                                d="M14.4957 7.99965C14.0255 8.00473 13.6307 8.35538 13.5702 8.82175C13.1176 11.8974 10.2575 14.0238 7.18182 13.5712C6.13248 13.4168 5.14812 12.9691 4.34213 12.2796L5.06769 11.554C5.31087 11.3108 5.31082 10.9164 5.06754 10.6732C4.9508 10.5565 4.79245 10.4909 4.62736 10.4909H1.77123C1.42727 10.4909 1.14844 10.7697 1.14844 11.1137V13.9699C1.14853 14.3138 1.42741 14.5926 1.77138 14.5925C1.93647 14.5925 2.09482 14.5269 2.21156 14.4102L3.0212 13.6006C6.10801 16.3531 10.8418 16.0822 13.5943 12.9953C14.5699 11.9013 15.203 10.545 15.415 9.09457C15.4989 8.58061 15.1504 8.0959 14.6364 8.01194C14.5899 8.00432 14.5429 8.0002 14.4957 7.99965Z"
                                                fill="currentColor"></path>
                                        </g>
                                    </svg> -->
                                    
                                    <a href="#" data-bs-chatid="{{ $chat->profile_id }}" data-toggle="tooltip" data-placement="top" title="When completed response then after you can delete it" class="profile_info{{ $chat->profile_id }}">
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
                                </a>
                                <a href="" data-bs-chatid="{{ $chat->profile_id }}" style="display: none;" class="remove-chat profile_{{ $chat->profile_id }}">
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
                                </a>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <div class="start_chat_part">
                    <div id="wrapper" class="wrapper">
                        <div id="content" class="content">
                            <div class="chat-profile-bar">

                                <div class="backtochat">
                                    <img src="https://candy.ai/assets/left-arrow-198ce01386bf370e33697c53d1cf90f5e8107c896bd0a849f0d1f67acf905c85.svg"
                                        class="">
                                </div>

                                <div class="asuna-saito">
                                    <div class="asuna-image">
                                        <img src="{{ $imgUrl1 }}">
                                    </div>
                                    <div class="asuna-name">

                                        <h6>{{ $name }}</h6>
                                    </div>
                                </div>
                                <div class="toggle-button-right" id="show-toggle-btn">
                                    <img src="{{ URL::asset('public/front/img/toggle-button.svg') }}">
                                </div>
                            </div>

                            <div id="bindhtml">
                            
                            </div>
                                
                            <div class="searchbar-footer">
                            @if(isset($getAllReciverUser[1]->message_text))
                            <ul class="suggestion" style="display: none;">
                             <li class="suggestion-text">Suggestion: </li>
                                <li><a href="#" class="suggestion-link">Hey! How's your day been?</a></li>
                                @else
                                <ul class="suggestion">
                                 <li class="suggestion-text">Suggestion: </li>
                                <li><a href="#" class="suggestion-link">Hey! How's your day been?</a></li>
                                @endif
                            </ul>
                                <div class="type_message">
                                <!-- <form id="message_form" action="{{ route('chat.userMessage') }}" method="POST"> -->
                                <form id="message_form" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="receiver_id" value="{{ request()->segment(count(request()->segments())) }}">
                                        <input type="hidden" name="sender_id" value="{{ session('user_id') }}">
                                        <input type="text" name="message" id="type_message" autocomplete="off" placeholder="Type action message">
                                        <div class="dropdown">
                                            <a class="btn" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <img height="24" width="24" src="{{ URL::asset('public/front/img/add-photo.png') }}"> Ask <i
                                                    class="bi bi-chevron-down"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Show me...</a></li>
                                                <li><a class="dropdown-item" href="#">Send me...</a></li>
                                                <li><a class="dropdown-item" href="#">Send</a></li>
                                                <li><a class="dropdown-item" href="#">Can i see...</a></li>
                                                <li><a href="#"  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#How_to_use"><img
                                                            src="{{ URL::asset('public/front/img/ask-info.svg') }}"> How
                                                        to use</a></li>
                                            </ul>
                                        </div>
                                        @if(session('user_id'))
                                        <button type="button" id="new_message">
                                            <img height="24" width="24" src="{{ URL::asset('public/front/img/message.png') }}">
                                        </button>
                                        @else
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#please_register" >
                                            <img height="24" width="24" src="{{ URL::asset('public/front/img/message.png') }}">
                                        </button>
                                        @endif
                                    </form>
                                </div>
                            </div>

                        </div>


                        <div id="aside" class="sidebar" style="display: none;">
                            <div class="sidebar_main_carousel">
                                <div id="carouselExampleFade" class="carousel slide carousel-fade"
                                    data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                    </div>
                                    <div class="back_btn">
                                        <img
                                            src="https://candy.ai/assets/left-arrow-198ce01386bf370e33697c53d1cf90f5e8107c896bd0a849f0d1f67acf905c85.svg">
                                        <div class="text-white text-sm font-semibold leading-normal">Back</div>
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach($profileImages as $key => $profileImages)
                                        @php
                                        $imgUrl = isset($profileImages->image_path) ?
                                        asset('storage/app/public').'/'.$profileImages->image_path : '';
                                        @endphp

                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
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
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleFade" data-bs-slide="next">
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
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/Personality.png') }}">
                                    </div>
                                    <div class="attributes_txt">
                                        <span>PERSONALITY</span>
                                        <h6>{{ $personality }}</h6>
                                    </div>
                                </div>
                                <div class="attributes_item">
                                    <div class="attributes_icon">
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/Occupation.png') }}">
                                    </div>
                                    <div class="attributes_txt">
                                        <span>Occupation</span>
                                        <h6>{{ $occupation }}</h6>
                                    </div>
                                </div>
                                <div class="attributes_item">
                                    <div class="attributes_icon">
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/hobbies.png') }}">
                                    </div>
                                    <div class="attributes_txt">
                                        <span>HOBBIES</span>
                                        <h6>{{ $hobbies }}</h6>
                                    </div>
                                </div>
                                <div class="attributes_item">
                                    <div class="attributes_icon">
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/relationship.png') }}">
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
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/body.png') }}">
                                    </div>
                                    <div class="attributes_txt">
                                        <span>BODY</span>
                                        <h6>{{ $body_description }}</h6>
                                    </div>
                                </div>
                                <div class="attributes_item">
                                    <div class="attributes_icon">
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/age.png') }}">
                                    </div>
                                    <div class="attributes_txt">
                                        <span>AGE</span>
                                        <h6 style="text-align: center;">{{ $age }}</h6>
                                    </div>
                                </div>
                                <div class="attributes_item">
                                    <div class="attributes_icon">
                                        <img height="20" width="20" src="{{ URL::asset('public/front/img/ethnicity.png') }}">
                                    </div>
                                    <div class="attributes_txt">
                                        <span>ETHNICITY</span>
                                        <h6 style="text-align: center;">{{ $ethnicity }}</h6>
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



<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="false_thumb" tabindex="-1" aria-labelledby="How_to_useModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="color: white;font-size: larger;">Provide additional feedback</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="prompt_for_image">
                        <p>Write your message here.</p>
                            <textarea id="messageTextarea" placeholder="What is the issue, how could it be improved?" rows="4" cols="26"
                                style="background: black;color: white;"></textarea>
                        <div class="pasination">
                       
                        <a href="#" id="sendLink" data-bs-toggle="modal" data-bs-target="#false_thumbstep2" >send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="false_thumbstep2" tabindex="-1" aria-labelledby="How_to_useModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="prompt_for_image">
                        <h6>Thank you for your message!</h6>
                        <p>Your message has been sent.</p>
                        <div class="pasination">

                            <a href="#" data-bs-dismiss="modal" id="close_feedback" aria-label="Close">close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="How_to_use" tabindex="-1" aria-labelledby="How_to_useModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><img src="{{ URL::asset('public/front/img/ask-info.svg') }}"> How to use</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="prompt_for_image">
                        <h6>How to Prompt for Images</h6>
                        <p>Start your request using one of these phrases:</p>
                        <ul>
                            <li>Send me...</li>
                            <li>Show me...</li>
                            <li>Can I see...</li>
                            <li>Send...</li>
                        </ul>
                        <div class="pasination">
                            <p>Step 1 of 2</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#How_to_usestep2" >next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="How_to_usestep2" tabindex="-1" aria-labelledby="How_to_useModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><img src="{{ URL::asset('public/front/img/ask-info.svg') }}"> How to use</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="prompt_for_image">
                        <h6>Complete the sentence by specifying what you'd like to see.</h6>
                        <p>Examples:</p>
                        <ul>
                            <li>"Send me a selfie"</li>
                            <li>"Show me your face"</li>
                            <li>"Can I see a picture of you"</li>
                        </ul>
                        <div class="pasination">
                            <p>Step 2 of 2</p>
                            <a href="#" data-bs-dismiss="modal" aria-label="Close">Got it</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="please_register" tabindex="-1" aria-labelledby="please_registerModalLabel" data-backdrop="true" data-keyboard="true" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="please_registerModalLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="modal-body">
                <h2 style="color: white;text-align: center;">Members Only!</h2>

                <h7 class="mt-3" style="color: white;text-align: center;display: flex;"> Please login or register in order to use this feature </h7>

                <div class="row mt-4">
                    <div class="col-6">
                    <a href="{{ route('register') }}" class="register_btn"><img src="{{ URL::asset('public/front/img/edit.png') }}" width="15" height="15">&nbsp;Register</a>
                    <!-- <span>By signing up, you agree to <a href="#">Terms of Service</a></span> -->
                    </div>
                    <div class="col-6">
                        <a href="{{ route('login') }}" class="login_btn"><img src="{{ URL::asset('public/front/img/enter.png') }}" width="15" height="15">&nbsp;&nbsp;Login</a>
                    <!-- <span>By signing up, you agree to <a href="#">Terms of Service</a></span> -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('front.layout.footer')
<script>
    function loadchats(){
    var currentUrl = window.location.href;
    var appUrl = @json(config('app.url'));
    var lastId = currentUrl.split('/').filter(Boolean).pop();
    var url = appUrl + "/mobile_loadchats/" + lastId;

    $.ajax({
        url: url,
        method: 'GET',
        data: {'id' : lastId},
        success: function(data) {
            $('#bindhtml').html(data);
            var chatContainer = $('#chatContent');
            chatContainer.scrollTop(chatContainer.prop('scrollHeight'));
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status);
        }
    });
}
$(document).ready(function() {
    loadchats();
    $('body').on('click', '#new_message', function() {
        if ($('#type_message').val()) {
            <?php if(session('user_id')) { ?>
        $('.new_message').append('<div class="col-12" bis_skin_checked="1"><div class="send_message" bis_skin_checked="1"><span id="chat-message">'+ $('#type_message').val() +'</span></div></div>');

        $('.new_message').append('<div class="chat_content_box hidedots" id="hidedots" style="width: 93px; margin-left: 15px;"> <div class="dot-elastic" > <span class="dot dot1"></span> <span class="dot dot2"></span> <span class="dot dot3"></span> </div> </div>');
        <?php } ?>
        var inputValue = $('#type_message').val();
  
        // Check if the input contains the word "show"
        if (inputValue.includes('show')) {
            $('.hidedots').css('display', 'none');
            // The word "show" is present in the input
            var charname= "{{ $user->name }}";
            <?php if(session('user_id')) { ?>
            $('.new_message').append('<div class="col-12"><div class="show_picture"><div class="picture_circle"></div><p id="loading-progress">0%</p><h5>Please Wait</h5><h6 id="loading-text">'+ charname +' is taking a picture</h6></div></div>');
            setTimeout(function() {
                updateLoading('0%', 'Please Wait');
            }, 1000);

            setTimeout(function() {
                updateLoading('20%', 'Processing...');
            }, 3000);

            setTimeout(function() {
                updateLoading('50%', 'Almost There...');
            }, 5000);

            setTimeout(function() {
                updateLoading('80%', 'Complete');
            }, 10000);

            setTimeout(function() {
                updateLoading('100%', 'Complete');
            }, 15000);
            // You can add your condition or code here
            <?php } ?>
        } 
        setTimeout(function() {
                    $("#type_message").val('');
                    $('.suggestion-text').hide();
                    $('.suggestion-link').hide();
                }, 100); // 3000 milliseconds (3 seconds)
            // Make the input element readonly
            // $("#type_message").prop("readonly", true);
        const chatContentScrollnewchat = document.querySelector('.chat_content');
        chatContentScrollnewchat.scrollTop = chatContentScrollnewchat.scrollHeight;
        
        document.addEventListener("DOMContentLoaded", function() {
            // Select the message and dot elements
            var messageElement = document.getElementById("chat_content_box");

            // Display the three dots animation
            messageElement.style.display = "block";


            // Hide the three dots animation and show the message after 3 seconds
            setTimeout(function() {
                messageElement.style.display = "none";
            }, 3000); // 3000 milliseconds (3 seconds)
        });

        var formData = $('#message_form').serialize();
        var appUrl = @json(config('app.url'));
        var url = appUrl + "/chat/message/userMessage";

        var currentUrl = window.location.href;
        var lastId = currentUrl.split('/').filter(Boolean).pop();
        $('.profile_'+lastId).css('pointer-events', 'none');
        $('[data-toggle="tooltip"]').tooltip();
        $('.profile_'+lastId).hide();
        $('.profile_info'+lastId).show();
        // $('.profile_'+lastId).attr('data-tooltip', 'When completed response then after you can delete it');
        $.ajax({
            url: url,
            method: 'POST',
            data: formData, // Serialized form data
            success: function(data) {
                $('.profile_'+lastId).show();
                $('.profile_'+lastId).css('pointer-events', 'auto');
                // Assuming your link has a class, replace '.your-link-class' with your actual class or ID
                $('.profile_info'+lastId).hide();
                loadchats();
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status);
            }
        });
    }
    })

        setTimeout(function() {
            $('html, body').animate({
            scrollTop: $('.new_message').offset().top
            }, 'slow');
        }, 500);
    // $('#new_message').append()
});
function updateLoading(progress, text) {
               $('#loading-progress').text(progress);
            //    $('#loading-text').text(progress);
                loadingtext.val(text);
            }

</script>



<script>
if (window.innerWidth <= 1199) {

    $('#mobile_view').on('click', function() {

        $('.content').show();
        $('.start_chat_part').show();
        $('.chat-menu').hide();


    });

    $('#show-toggle-btn').on('click', function() {

        $('#aside').show();
        $('.content').hide();
        $('.chat-menu').hide();

    });

    $('.back_btn').on('click', function() {

        $('.content').show();
        $('.start_chat_part').show();
        $('.chat-menu').hide();
        $('#aside').hide();


    });

    $('.backtochat').on('click', function() {

        $('.content').hide();
        $('.start_chat_part').hide();
        $('.chat-menu').show();
        $('#aside').hide();


    });


}
</script>


<script>
// Wait for the page to load
document.addEventListener("DOMContentLoaded", function() {
    // Select the message and dot elements
    var messageElement = document.getElementById("message");
    var dotElement = document.querySelector(".dot-elastic");

    // Display the three dots animation
    dotElement.style.display = "block";

    // Hide the three dots animation and show the message after 3 seconds
    setTimeout(function() {
        dotElement.style.display = "none";
        messageElement.style.display = "block";
    }, 1500); // 3000 milliseconds (3 seconds)
});
</script>


<script>
    // Get the suggestion link element
    const suggestionLink = document.querySelector('.suggestion-link');

    // Get the message input element
    const messageInput = document.getElementById('type_message');

    // Add a click event listener to the suggestion link
    suggestionLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior

        // Get the text from the suggestion link
        const suggestionText = suggestionLink.textContent;

        // Set the input field's value to the suggestion text
        messageInput.value = suggestionText;

        // Hide the suggestion by setting its display to "none"
        suggestionLink.parentNode.style.display = "none";
    });

    
// Get the "new_message" button element
const newMessageButton = document.getElementById('new_message');

// Add a click event listener to the button
newMessageButton.addEventListener('click', function() {
    // Clear the input field's value
    setTimeout(function() {
        messageInput.value = '';
    }, 500); // 3000 milliseconds (3 seconds)

});
</script>

<script>
    // Get the dropdown items (anchors)
    const dropdownItems = document.querySelectorAll('.dropdown-item');

    // Get the message input element
    const messageInput1 = document.getElementById('type_message');

    // Add a click event listener to each dropdown item
    dropdownItems.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            // Get the text of the clicked item
            const selectedText = item.textContent;

            // Set the input field's value to the selected text
            messageInput1.value = selectedText;
        });
    });
</script>


<script>
// Add this script at the end of your HTML body, just before the </body> tag.
document.addEventListener('DOMContentLoaded', function() {
    // Get the chat_content element
    const chatContent = document.querySelector('.chat_content');

    // Scroll to the bottom of the chat_content element
    chatContent.scrollTop = chatContent.scrollHeight;
});
</script>



<script>
function likedMessage(id) {
    var str = "{{URL::to('chat/liked', [], true)}}/" + id;

    $.ajax({
        url: str,
        success: function(result) {
            location.reload();
            console.log(result); // Example: Display the response in the console
        }
    });
}

document.getElementById('sendLink').addEventListener('click', function(e) {
    e.preventDefault();
    var messageTextarea = document.getElementById('messageTextarea');
    var messageId = document.querySelector('[data-bs-messageid]').getAttribute('data-bs-messageid');
    unlikedMessage(messageTextarea.value, messageId);
});

document.getElementById('close_feedback').addEventListener('click', function(e) {
    e.preventDefault();
    location.reload();
});


function unlikedMessage(message, messageId) {
    console.log("Message: " + message);
    console.log("Message ID: " + messageId);

    var str = "{{URL::to('chat/unliked', [], true) }}/" + messageId;
    $.ajax({
        type: "GET",
        url: str,
        data: {
        message : message
        },
        success: function(result) {
            // location.reload();
            console.log(result); // Example: Display the response in the console
        }
    });
}
</script>


<script>
//      
$('.remove-chat').click(function(e) {
    var chatid = $(this).data('bs-chatid');
    var url = "{{ route('chat.delete', ['id' => ':chatid'], [], true) }}";
    url = url.replace(':chatid', chatid);

      e.preventDefault();
            swal({
            title: "Are you sure?",
            text: "Wants to delete chat?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                            type: 'GET',
                            data: {
                                _token: '{{ csrf_token() }}', // Include the CSRF token
                                chatid: chatid
                            },
                        success: function(result) {
                            swal("Poof! Your chat has been deleted!", {
                                icon: "success",
                            }).then((willDelete) => {
                                if (willDelete) {
                                    if(result.data == ''){
                                    var appUrl = @json(config('app.url'));
                                    var newUrl = appUrl + "/explore"; // Replace with your desired URL
                                    window.location.href = newUrl;  
                                    }else{
                                    var appUrl = @json(config('app.url'));
                                    var newUrl = appUrl + "/chat/message/" + result.data; // Replace with your desired URL
                                    window.location.href = newUrl; 
                                    }
                                }
                            });
                        }
                    });
                } else {
                    swal("Your chat is safe!");
                }
            });
            });
</script>