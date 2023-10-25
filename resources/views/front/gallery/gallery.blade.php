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
                <span>3/3 pictures</span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="limit_txt justify-content-lg-end">
                <a href="#" class="become_premium_btn"><img src="{{ URL::asset('public/front/img/premium-white.svg') }}"> Become Premium</a>
              </div>
            </div>
          </div>
        </div>
        <div class="pictures_box">
          <div class="pictures_head">
            <h2>Asuna Saito <span>2 Pictures</span></h2>
            <a href="#" class="see_btn d-none d-lg-block">See all</a>
          </div>
          <div class="row">
            <div class="col-6 col-sm-3 col-lg-2">
              <div class="pictures_item" data-bs-toggle="modal" data-bs-target="#gallery">
                <p><img src="{{ URL::asset('public/front/img/1.webp') }}"></p>
              </div>
            </div>
            <div class="col-6 col-sm-3 col-lg-2">
              <div class="pictures_item" data-bs-toggle="modal" data-bs-target="#gallery">
                <p><img src="{{ URL::asset('public/front/img/gallery-img2.webp') }}"></p>
              </div>
            </div>
          </div>
          <div class="pictures_head d-block d-lg-none">
            <a href="#" class="see_btn">See all</a>
          </div>
        </div>
        <div class="pictures_box">
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
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container_fluid">
      <div class="footer_content">
        <ul class="social_txt">
          <li><a href="#">Discord</a></li>
          <li><a href="#" data-bs-toggle="modal" data-bs-target="#contact">Contact</a></li>
          <li><a href="#">Affiliate</a></li>
        </ul>
        <ul class="links">
          <li><a href="terms-of-services.html">Terms of Service</a></li>
          <li><a href="privacy-policies.html">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
  </footer><!-- End  Footer -->


<!-- Modal -->
<div class="contact_popup">
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
</div>


<!-- Modal -->
<div class="gallery_popup">
  <div class="modal fade" id="gallery" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="gallery_popup_img">
            <img src="{{ URL::asset('public/front/img/gallery-img2.webp') }}">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Vendor JS Files -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ URL::asset('public/front/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="{{ URL::asset('public/front/vendor/aos/aos.js"></script>
<script src="{{ URL::asset('public/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="{{ URL::asset('public/front/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{ URL::asset('public/front/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{ URL::asset('public/front/vendor/swiper/swiper-bundle.min.js"></script>
<script src="{{ URL::asset('public/front/vendor/typed.js/typed.umd.js"></script>
<script src="{{ URL::asset('public/front/vendor/waypoints/noframework.waypoints.js"></script> -->
@include('front.layout.footer')
<!-- Template Main JS File -->
<script src="{{ URL::asset('public/front/js/main.js"></script>
<script>
  $(document).ready(function () {
    $('.toggle-button-right').on('click', function () {
      $('.sidebar').toggleClass('isClosed');
      $('.sidebar ul.nav').toggleClass('isClosed');
    });
  });
</script>