 <!-- ======= Footer ======= -->
 <footer id="footer">
    <div class="container_fluid">
      <div class="footer_content">
        <ul class="social_txt">
          <li><a href="https://discord.com/" target="_blank">Discord</a></li>
          @if(session('user_id'))
          <li><a href="#" data-bs-toggle="modal" data-bs-target="#contactmodel">Contact</a></li>
          @else
          <li><a href="{{ route('login') }}" >feedback</a></li>
          @endif
          <li><a href="#">Affiliate</a></li>
        </ul>
        <ul class="links">
          <li><a href="{{ route('terms.terms') }}">Terms of Service</a></li>
          <li><a href="{{ route('privacy.privacy') }}">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
  </footer><!-- End  Footer -->
  <!-- Vendor JS Files -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="contactmodel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="How_to_useModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 style="color: white;font-size: larger;">Contact us</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="prompt_for_image">
                        <p>Write your message here.</p>
                        <textarea id="messageTextarea" placeholder="Description"
                            rows="4" cols="34" style="background: black;color: white;width: 100%;border-radius: 5px;padding: 5px 10px;"></textarea>
                            <input type="hidden" name="user_id" id="user_id" value="{{ session('user_id') }}">
                        <div class="pasination">

                            <a href="#" style="width: 100%;text-align: center;" id="sendLink" data-bs-toggle="modal" data-bs-target="#thankyou">Send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="thankyou" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="How_to_useModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <div style="text-align: center;margin: 5px;">
                    <img src="{{ URL::asset('public/front/img/thankyoucontact.svg') }}" alt="">
                </div>
                      <h4 style="color: white;font-size: 21px;text-align: center;margin: 4px;">Thank you for your message!</h4>
                      <p style="color: white;font-size: 13px;text-align: center;">Your message has been sent.</p>
                </div>
            </div>
        </div>
    </div>
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

  <script>
$(document).ready(function() {
    // Add a click event handler for the "Send" link
    $("#sendLink").on("click", function(e) {
        e.preventDefault(); // Prevent the link from navigating to a different page
        var message = $("#messageTextarea").val();
        var userId = $("#user_id").val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        // Make the AJAX request
        $.ajax({
            url: "{{ route('contact') }}", // Replace with your actual AJAX endpoint URL
            type: "POST", // Use POST or GET, depending on your needs
            data: {
                message: message,
                user_id: userId
            },
            success: function(response) {
                // Handle the success response here
                console.log(response);
                // You can update the DOM or perform other actions based on the response
            },
            error: function(error) {
                // Handle any errors here
                console.error(error);
            }
        });
    });
});
</script>

</body> 

</html>