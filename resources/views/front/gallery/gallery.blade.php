@include('front.layout.front')
@include('front.layout.header')

  <!-- Start #main -->
  <main id="main">
    <section class="gallery_section">
      <div class="container-fluid">
        <div class="pictures_limit">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="limit_txt">
                <h3>You have reached the free pictures limit:</h3>
              
                <span>{{ count($responseArr) }} / {{ $totalCount }} pictures</span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="limit_txt justify-content-lg-end">
                <a href="{{ route('subscription.subscription') }}" class="become_premium_btn"><img src="{{ URL::asset('public/front/img/premium-white.svg') }}"> Become Premium</a>
              </div>
            </div>
          </div>
        </div>
        @foreach($responseArr as $img)
        <div class="pictures_box">
          <div class="pictures_head">
         
            <h2> {{ $img->name }} <span>{{ $img->image_count }} Pictures</span></h2>
            <!-- <a href="#" class="see_btn d-none d-lg-block">See all</a> -->
          </div>
          <div class="row">
          @foreach($img->images as $img_url)
            <div class="col-6 col-sm-3 col-lg-2">
              <div class="pictures_item" data-bs-toggle="modal" data-bs-imageid="{{ $img_url->message_id }}" data-bs-link="{{ $img_url->media_url }}" data-bs-target="#gallery">
                <p><img src="{{ $img_url->media_url }}"></p>
              </div>
            </div>
            <!-- <div class="col-6 col-sm-3 col-lg-2">
              <div class="pictures_item" data-bs-toggle="modal" data-bs-target="#gallery">
                <p><img src="{{ URL::asset('public/front/img/gallery-img2.webp') }}"></p>
              </div>
            </div> -->
         
          @endforeach
          </div>
          <div class="pictures_head d-block d-lg-none">
            <!-- <a href="#" class="see_btn">See all</a> -->
          </div>
        </div>
       
        <!-- <div class="pictures_box">
          <div class="pictures_head">
            <h2>Naomi Carter <span>1 Pictures</span></h2>
            <a href="#" class="see_btn d-none d-lg-block">See all</a>
          </div>
          <div class="row">
            <div class="col-6 col-sm-3 col-lg-2">
              <div class="pictures_item" data-bs-toggle="modal" data-bs-target="#gallery">
                <p><img src="{{ URL::asset('public/front/img/gallery-img3.webp') }}"></p>
              </div>
            </div>
          </div>
          <div class="pictures_head d-block d-lg-none">
            <a href="#" class="see_btn">See all</a>
          </div>
        </div> -->
      </div>
      @endforeach
    </section>
  </main>
  <!-- End #main -->

<!-- Modal -->
<!-- <div class="contact_popup">
  <div class="modal fade" id="contact" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="contact_details">
            <h5>Contact Us</h5>
            <p>Write your message here.</p>
            <form action="#">
              <textarea name="message" rows="4" placeholder="Description"></textarea>
              <button type="submit">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->


<!-- Modal -->
<div class="gallery_popup">
  <div class="modal fade" id="gallery" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <p id="image_id" value="" style="color: white;margin-top: 11px;">
          <svg width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M14.0002 3.83301H2.00016C1.82335 3.83301 1.65378 3.90325 1.52876 4.02827C1.40373 4.15329 1.3335 4.32286 1.3335 4.49967C1.3335 4.67649 1.40373 4.84605 1.52876 4.97108C1.65378 5.0961 1.82335 5.16634 2.00016 5.16634H3.3335V13.1663C3.33366 13.6967 3.54442 14.2053 3.91946 14.5804C4.2945 14.9554 4.80311 15.1662 5.3335 15.1663H10.6668C11.1972 15.1662 11.7058 14.9554 12.0809 14.5804C12.4559 14.2054 12.6667 13.6967 12.6668 13.1663V5.16634H14.0002C14.177 5.16634 14.3465 5.0961 14.4716 4.97108C14.5966 4.84605 14.6668 4.67649 14.6668 4.49967C14.6668 4.32286 14.5966 4.15329 14.4716 4.02827C14.3465 3.90325 14.177 3.83301 14.0002 3.83301ZM7.3335 11.1663C7.3335 11.3432 7.26326 11.5127 7.13823 11.6377C7.01321 11.7628 6.84364 11.833 6.66683 11.833C6.49002 11.833 6.32045 11.7628 6.19543 11.6377C6.0704 11.5127 6.00016 11.3432 6.00016 11.1663V7.83301C6.00016 7.6562 6.0704 7.48663 6.19543 7.3616C6.32045 7.23658 6.49002 7.16634 6.66683 7.16634C6.84364 7.16634 7.01321 7.23658 7.13823 7.3616C7.26326 7.48663 7.3335 7.6562 7.3335 7.83301V11.1663ZM10.0002 11.1663C10.0002 11.3432 9.92993 11.5127 9.8049 11.6377C9.67988 11.7628 9.51031 11.833 9.3335 11.833C9.15669 11.833 8.98712 11.7628 8.86209 11.6377C8.73707 11.5127 8.66683 11.3432 8.66683 11.1663V7.83301C8.66683 7.6562 8.73707 7.48663 8.86209 7.3616C8.98712 7.23658 9.15669 7.16634 9.3335 7.16634C9.51031 7.16634 9.67988 7.23658 9.8049 7.3616C9.92993 7.48663 10.0002 7.6562 10.0002 7.83301V11.1663Z" fill="currentColor"></path>
                    <path d="M6.66667 3.16634H9.33333C9.51014 3.16634 9.67971 3.0961 9.80474 2.97108C9.92976 2.84605 10 2.67649 10 2.49967C10 2.32286 9.92976 2.15329 9.80474 2.02827C9.67971 1.90325 9.51014 1.83301 9.33333 1.83301H6.66667C6.48986 1.83301 6.32029 1.90325 6.19526 2.02827C6.07024 2.15329 6 2.32286 6 2.49967C6 2.67649 6.07024 2.84605 6.19526 2.97108C6.32029 3.0961 6.48986 3.16634 6.66667 3.16634Z" fill="currentColor"></path>
                </g>
            </svg>
        </p>
        </div>
        <div class="modal-body">
          <div class="gallery_popup_img">
            <img src="" id="image_url_put">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Vendor JS Files -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ URL::asset('public/front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ URL::asset('public/front/vendor/aos/aos.js') }}"></script>
<script src="{{ URL::asset('public/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- <script src="{{ URL::asset('public/front/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('public/front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('public/front/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('public/front/vendor/typed.js/typed.umd.js') }}"></script>
<script src="{{ URL::asset('public/front/vendor/waypoints/noframework.waypoints.js') }}"></script> -->
@include('front.layout.footer')
<!-- Template Main JS File -->
<script src="{{ URL::asset('public/front/js/main.js') }}"></script>
<script>
  $(document).ready(function () {
    $('.toggle-button-right').on('click', function () {
      $('.sidebar').toggleClass('isClosed');
      $('.sidebar ul.nav').toggleClass('isClosed');
    });
  });
</script>

<script>
  // Add a click event listener to elements with the class "pictures_item"
  document.querySelectorAll('.pictures_item').forEach(function (item) {
    item.addEventListener('click', function () {
      // Get the image URL from the data attribute
      var imageUrl = item.getAttribute('data-bs-link');
      var imageid = item.getAttribute('data-bs-imageid');
     
      
      // Set the src attribute of the image element in the modal
      document.getElementById('image_url_put').src = imageUrl;
      document.getElementById('image_id').value = imageid;
    });
  });

  
  document.getElementById('image_id').addEventListener('click', function() {
    // Your code to handle the click event goes here
    console.log('Button clicked!');
    var buttonValue = this.value;
    gallaryimage(buttonValue)
    // You can add more code here to perform specific actions on click
  });
</script>

<script>
function gallaryimage(imageid) {

  var str = "{{ URL::to('gallary/delete') }}/" + imageid;
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "GET",
                    url: str,
                    data: {
                    imageid: imageid
                  },
                    success: function(result) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        }).then((willDelete) => {
                            if (willDelete) {
                                location.reload(true);
                            }
                        });
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
}
</script>