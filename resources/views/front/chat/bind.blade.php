                        <div class="chat_content" id="chatContent">
                            <div class="row new_message" >
                                @if(!empty($getAllReciverUser))
                                @foreach ($getAllReciverUser as $chat_user)
                                @if($chat_user->sender_id == $chat_user->user_id)
                                <!-- style="display: none;" style="display: none;" -->
                                @if(!empty($chat_user->message_text))
                                <div class="col-12 scrolltop mb-2">
                                    <div class="have_we_met">
                                        <div class="chat_content_box">
                                            <p id="message">{{ $chat_user->message_text }}</p>
                                            <div class="volume">
                                                <span><svg id="play-icon" width="20 " class="text-[#C14DA0]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z">
                                                        </path>
                                                    </svg></span>
                                            </div>
                                        </div>
                                        <!-- <div class="message_feedback">
                                            @if($chat_user->message_liked == 'Liked')
                                            <a href="#"><img
                                                    src="{{ URL::asset('public/front/img/true_svg.svg') }}"></a>
                                            @else

                                            @if($chat_user->message_liked == 'Unliked')
                                            <a href="#"><img
                                                    src="{{ URL::asset('public/front/img/thumbs-up.svg') }}"></a>
                                            <a href="#"><img
                                                    src="{{ URL::asset('public/front/img/active-thumb.svg') }}"></a>
                                            @else
                                            <a href="#" onclick="likedMessage('{{$chat_user->message_id}}')"><img
                                                    src="{{ URL::asset('public/front/img/thumbs-up.svg') }}"></a>
                                            <a href="#" class="message-link" data-bs-toggle="modal" data-bs-target="#false_thumb"
                                                data-bs-messageid="{{$chat_user->message_id}}"><img
                                                    src="{{ URL::asset('public/front/img/thumbs-down.svg') }}"></a>
                                            @endif
                                            @endif
                                        </div> -->
                                    </div>
                                </div>
                                @endif
                                @if($chat_user->media_url)

                                <div class="col-12 mt-4">
                                    <div class="chat_content_img">
                                        <img src="{{ $chat_user->media_url }}">
                                    </div>
                                </div>
                                @endif
                                @else
                                <div class="col-12">
                                    <div class="send_message">
                                        <span id="chat-message">{{ $chat_user->message_text }}</span>
                                    </div>
                                </div>

                                @endif
                                @endforeach
                                @endif

                                </div>
                        </div>
