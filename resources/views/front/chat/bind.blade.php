<div class="chat_content" id="chatContent">
    <div class="row new_message" >
        @if(!empty($getAllReciverUser))
            @php 
                $totalMessage = (count($getAllReciverUser) - 1); 
                $receiverCount = 0;
            @endphp
            @foreach ($getAllReciverUser as $keys => $chat_user)
                @if($chat_user->sender_id == $chat_user->user_id)
                    @if(!empty($chat_user->message_text))
                    <?php
                    //$chat_user = // ... your $chat_user object;

                    // Check if {{first_name}} is present in the message text
                    if (strpos($chat_user->message_text, '{{first_name}}') !== false) {
                        // Replace {{first_name}} with the actual first name
                        $messageText = str_replace('{{first_name}}', Auth::user()->name, $chat_user->message_text);
                    } else {
                        // If {{first_name}} is not present, add a space
                        $messageText = str_replace('{{first_name}}', ' ', $chat_user->message_text);
                    }

                    // Output the result with line breaks converted to HTML breaks
                    //  echo nl2br($messageText);
                    ?>
                        <div class="col-12 scrolltop mb-2">
                            <div class="have_we_met">
                                <div class="chat_content_box">
                                    <div class="">
                                        <p id="message" class="sender_message_{{ $keys }}"><?= nl2br($messageText) ?></p>
                                    </div>
                                    <div class="volume">
                                        <span>
                                            <svg id="play-icon" width="20 " class="text-[#C14DA0]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"></path></svg>
                                        </span>
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
                    @if($keys == $totalMessage && $chat_user->media_url == '')
                        <!-- <script>
                            $( document ).ready(function() {
                                // setTimeout(function(){
                                $('.sender_message_{{ ($keys) }}').addClass('typedText');

                                const typedTextElements = document.getElementsByClassName("typedText");
                                const typingSpeed = 100;

                                function typeText(typedTextElement) {
                                    const originalText = typedTextElement.textContent || typedTextElement.innerText;
                                    
                                    for (let i = 0; i <= originalText.length; i++) {
                                    setTimeout(() => {
                                        typedTextElement.textContent = originalText.slice(0, i);
                                    }, i * typingSpeed);
                                    }

                                    // After typing, remove the blur effect (you can adjust the delay as needed)
                                    setTimeout(() => {
                                    typedTextElement.style.filter = "none";
                                    }, originalText.length * typingSpeed + 1000); // 1000 milliseconds = 1 second
                                }

                                // Apply blur effect and start typing for each element
                                for (let i = 0; i < typedTextElements.length; i++) {
                                    // typedTextElements[i].style.filter = "blur(5px)"; // You can apply blur individually if needed
                                    typeText(typedTextElements[i]);
                                }
                            });
                        </script> -->
                    @endif
                    @if($chat_user->media_url)
                        <div class="col-12 mt-2">
                            <div class="chat_content_img mb-4">
                                <img src="{{ $chat_user->media_url }}">
                            </div>
                        </div>

                        <!-- <script>
                            $( document ).ready(function() {
                                // setTimeout(function(){
                                $('.hidedots').hide();

                                $('.sender_message_{{ ($keys - 2) }}').removeClass('typedText');
                            });
                        </script> -->
                    @endif
                @else
                    @php 
                        $getFirstMessage = \App\Models\Profile::where('profile_id', $chat_user->profile_id)->first();
                        $checkNextMessage = \App\Models\Messages::where('receiver_id', $chat_user->sender_id)->where('sender_id', $chat_user->user_id)->where('sequence_message', $chat_user->sequence_message)->where('message_text', '!=', $getFirstMessage->first_message)->first();

                        $receiverCount = ($keys);
                    @endphp
                    @if($chat_user->message_text)
                        <div class="col-12">
                            <div class="send_message">
                                <p id="chat-message"><?= nl2br($chat_user->message_text) ?></p>
                            </div>
                        </div>
                    @endif
                    @if(!$checkNextMessage)
                        <!-- <script>
                            $( document ).ready(function() {
                                // setTimeout(function(){
                                    $('.sender_message_{{ ($keys - 1) }}').addClass('typedText')

                                    const typedTextElements = document.getElementsByClassName("typedText");
                                    const typingSpeed = 100;

                                    function typeText(typedTextElement) {
                                        const originalText = typedTextElement.textContent || typedTextElement.innerText;
                                        
                                        for (let i = 0; i <= originalText.length; i++) {
                                        setTimeout(() => {
                                            typedTextElement.textContent = originalText.slice(0, i);
                                        }, i * typingSpeed);
                                        }

                                        // After typing, remove the blur effect (you can adjust the delay as needed)
                                        setTimeout(() => {
                                        typedTextElement.style.filter = "none";
                                        }, originalText.length * typingSpeed + 1000); // 1000 milliseconds = 1 second
                                    }

                                    // Apply blur effect and start typing for each element
                                    for (let i = 0; i < typedTextElements.length; i++) {
                                        // typedTextElements[i].style.filter = "blur(5px)"; // You can apply blur individually if needed
                                        typeText(typedTextElements[i]);
                                    }
                                // }, 500);
                            });
                        </script> -->
                        <div class="chat_content_box hidedots" id="hidedots" style="width: 93px; margin-left: 15px;">
                            <div class="dot-elastic" >
                                <span class="dot dot1"></span>
                                <span class="dot dot2"></span>
                                <span class="dot dot3"></span>
                            </div>
                        </div>
                    @endif
                @endif

            @endforeach
        @endif
    </div>
</div>
