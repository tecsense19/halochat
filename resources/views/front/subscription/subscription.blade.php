
@include('front.layout.front')
@include('front.layout.header')
<main id="main">

<section class="subscribe_section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4">
        <div class="subscribe-item">
          <img src="{{ URL::asset('public/front/img/crown.svg') }}">
          <p>FIRST SUBSCRIPTION</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="subscribe-item text-center">
          <h6>Up to 70%  Off</h6>
        </div>
      </div>
      <div class="col-md-4">
        <div class="subscribe-item text-end">
          <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="choose_plan">
  <div class="container">
    <div class="choose_title">
      <h2>Choose your Plan</h2>
      <p>100% anonymous. You can cancel anytime.</p>
    </div>
    <div class="plans_box">
      <div class="row g-5">
        <div class="col-md-4">
          <div class="discount_box">
            <div class="discount_only_today">
              <h3>Get Exclusive Discount Only Today!</h3>
              <p>Up to <span>70%</span> off for first subscription</p>
              <div class="text-center">
                <img src="{{ URL::asset('public/front/img/real_left.png') }}">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="discount_box">
            <a href="#">
              <div class="pricing_box">
                <div class="offer_box">50% off</div>
                <h6>Premium</h6>
                <h3>$9.99 <span> $19.99 </span><small> / month</small></h3>
                <p>Cancel anytime, privacy in bank statement</p>
              </div>
            </a>
            <a href="#">
              <div class="pricing_box">
                <div class="offer_box">70% off</div>
                <div class="pupular_plan">
                  <h6>Premium</h6>
                  <div class="pupular_btn"><img src="{{ URL::asset('public/front/img/fire.svg') }}"> Popular</div>
                </div>
                <h3>$69.99 <span> $239.88 </span><small> / year</small></h3>
                <p>Cancel anytime, privacy in bank statement</p>
              </div>
            </a>
            <div class="pay_btn" id="paypal">
              <a href="#">Pay with <img src="{{ URL::asset('public/front/img/paypal.svg') }}"></a>
            </div>
            <div class="pay_btn" id="pay_creditcard">
              <a href="#"><img src="{{ URL::asset('public/front/img/credit-card.svg') }}" class="pe-1"> Pay with Credit / Debit Card</a>
            </div>
            <div class="pay_btn" id="pay_bitcoin">
              <a href="#">Pay with <img src="{{ URL::asset('public/front/img/bitcoin.svg') }}" class="ps-1"> <img src="{{ URL::asset('public/front/img/eth.svg') }}"> <img src="{{ URL::asset('public/front/img/litecoin.svg') }}"></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="discount_box">
            <div class="benefit">
              <h3>Premium Benefits</h3>
              <ul>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Create your own AI characters</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Unlimited text messages</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Get 100 FREE tokens / month</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Remove image blur</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Generate images</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Listen to voice messages</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Fast response time</li>
              </ul>
              <img src="{{ URL::asset('public/front/img/manga_right.png') }}">
            </div>
          </div>
        </div>
      </div>
      <div class="position-absolute bottom-0 end-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="242" height="475" viewBox="0 0 242 475" fill="none">
          <path opacity="0.05" fill-rule="evenodd" clip-rule="evenodd" d="M134.444 107.556C134.444 48.1543 182.599 0 242 0C301.401 0 349.556 48.1543 349.556 107.556V134.444H376.444C435.846 134.444 484 182.599 484 242C484 301.401 435.846 349.556 376.444 349.556H349.556V376.444C349.556 435.846 301.401 484 242 484C182.599 484 134.444 435.846 134.444 376.444V349.556H107.556C48.1543 349.556 0 301.401 0 242C0 182.599 48.1543 134.444 107.556 134.444H134.444V107.556ZM127.722 245.361C171.211 255.655 229.151 318.599 242 369.722C254.849 318.599 312.789 255.655 356.278 245.361C312.789 235.067 254.849 172.123 242 121C229.151 172.123 171.211 235.067 127.722 245.361Z" fill="url(#paint0_radial_4541_28606)"></path>
          <defs>
            <radialGradient id="paint0_radial_4541_28606" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(242 242) rotate(90) scale(242)">
              <stop stop-color="white"></stop>
              <stop offset="0.457376" stop-color="white" stop-opacity="0.991115"></stop>
              <stop offset="1" stop-color="#131313"></stop>
            </radialGradient>
          </defs>
        </svg>
      </div>
    </div>
    <div class="privacy_bank">
      <div class="antivirus">
        <span><img src="{{ URL::asset('public/front/img/shield.svg') }}"></span>
        <span>Antivirus <br> Secured</span>
      </div>
      <div class="antivirus">
        <span><img src="{{ URL::asset('public/front/img/privacy.svg') }}"></span>
        <span>Privacy in bank <br> statement</span>
      </div>
    </div>
  </div>
</section>


</main><!-- End #main -->

@include('front.layout.footer')