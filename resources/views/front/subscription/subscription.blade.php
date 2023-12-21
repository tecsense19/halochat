<?php

// print_r($subscriptionsUser);
// die;

?>
@include('front.layout.front')
@include('front.layout.header')
<style>
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: white;
    background-color: #B473E0;
}
.nav-link{
  color: white !important;
}
</style>
<main id="main">

<!-- <section class="subscribe_section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-6 col-sm-6 col-xl-4 d-none d-xl-block">
        <div class="subscribe-item">
          <img src="{{ URL::asset('public/front/img/crown-pur.svg') }}">
          <p>FIRST SUBSCRIPTION</p>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-xl-4">
        <div class="subscribe-item text-center">
          <h6>Up to 70%  Off</h6>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-xl-4">
         <div class="subscribe-item text-end">
          <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
        </div> 
      </div>
    </div>
  </div>
</section> -->

<section class="choose_plan">
  <div class="container">
    <div class="choose_title d-none d-xl-block">
      <h2>Choose your Plan</h2>
      <p>100% anonymous. You can cancel anytime.</p>
    </div>
    <div class="plans_box">
      <div class="row g-5">
        <div class="col-xl-4">
          <div class="discount_box">
            <div class="discount_only_today">
              <h3>Get Exclusive Discount Only Today!</h3>
              <p>Up to <span>70%</span> off for first subscription</p>
              <div class="text-center d-none d-xl-block">
                <img src="{{ URL::asset('public/front/img/real_left.png') }}">
              </div>
            </div>
          </div>
        </div>

    
        <div class="col-xl-4">
          <div class="discount_box">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="display: flex;justify-content: center;padding-bottom: 10px;">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Plans</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Package</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <ul class="nav nav-tabs" id="myTab" role="tablist" >
              @if(isset($response))
                @foreach($response['data'] as $key => $plans)
                  @if($plans['sku'] == 'Basic subscription')
                    @if($plans['category']['name'] == 'plans')
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <div class="pricing_box"  onclick="handleClick('{{ $response['data'][1]['id'] }}', '{{ $response['data'][1]['price'] }}', '4', '{{ $plans['sku'] }}')" data-id="{{ $response['data'][1]['id'] }}">
                              <!-- <div class="offer_box">50% off</div> -->
                              <h6>{{ $plans['sku'] }}</h6>
                              <h3>${{ number_format($plans['price'], 2) }} <span></span><small> / month</small></h3>
                              
                              <p>With free 100 credit</p>
                            </div>
                        </button>
                      </li>
                    @endif
                 @elseif($plans['sku'] == 'VIP subscription')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <div class="pricing_box" onclick="handleClick('{{ $response['data'][2]['id'] }}', '{{ $response['data'][2]['price'] }}', '4', '{{ $plans['sku'] }}')" data-id="{{ $response['data'][2]['id'] }}">
                              <!-- <div class="offer_box">70% off</div> -->
                              <div class="pupular_plan">
                                <h6>{{ $plans['sku'] }}</h6>
                                <!-- <div class="pupular_btn"><img src="{{ URL::asset('public/front/img/download-fire.svg') }}"> Popular</div> -->
                              </div>
                              <h3>${{ number_format($plans['price'], 2) }} <span></span><small> / month</small></h3>
                              <p>With free 500 credit</p>
                            </div>
                        </button>
                      </li>
                  @endif
                @endforeach
              @endif
            </ul>
            <form action="{{ url('payment') }}" id="paymentForm" method="post">
            {!! csrf_field() !!}
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" >
                <!-- <div class="pay_btn" id="paypal">
                  <a href="#">Pay with <img src="{{ URL::asset('public/front/img/paypal.svg') }}"></a>
                </div> -->
                <div class="pay_btn" id="pay_creditcard">
                  <button type="submit" style="background: border-box;border: 0;color: white;"><img src="{{ URL::asset('public/front/img/credit-card.svg') }}" class="pe-1"> Pay with Credit / Debit Card</button>
                </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- <div class="pay_btn" id="paypal">
                  <a href="#">Pay with <img src="{{ URL::asset('public/front/img/paypal.svg') }}"></a>
                </div> -->
                <div class="pay_btn" id="pay_creditcard">
                <input type="hidden" id="productid2" name="productid" value="2">
                  <input type="hidden" id="amount2" name="amount" value="69.000">
                  <input type="hidden" id="billing_model2" name="billing_model" value="4">
                  <input type="hidden" id="subscription_type2" name="subscription_type" value="Basic">
                <button type="submit" style="background: border-box;border: 0;color: white;"><img src="{{ URL::asset('public/front/img/credit-card.svg') }}" class="pe-1"> Pay with Credit / Debit Card</button>
                </div>
                <!-- <div class="pay_btn" id="pay_bitcoin">
                  <a href="#">Pay with <img src="{{ URL::asset('public/front/img/bitcoin.svg') }}" class="ps-1"> <img src="{{ URL::asset('public/front/img/eth.svg') }}"> <img src="{{ URL::asset('public/front/img/litecoin.svg') }}"></a>
                </div> -->
              </div>
            </div>
            </form>
              </div>

              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

              <ul class="nav nav-tabs" id="myTab" role="tablist" >
              @if(isset($response))
                @foreach($response['data'] as $key => $plans)
                  @if($plans['sku'] == '100 credit package')
                    @if($plans['category']['name'] == 'package')
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <div class="pricing_box"  onclick="handleClick('{{ $response['data'][$key]['id'] }}', '{{ $response['data'][$key]['price'] }}', '2')" data-id="{{ $response['data'][$key]['id'] }}">
                              <!-- <div class="offer_box">50% off</div> -->
                              <h6>{{ $plans['sku'] }}</h6>
                              <h3>${{ number_format($plans['price'], 2) }} <span></span><small></small></h3>
                              <p></p>
                            </div>
                        </button>
                      </li>
                    @endif
                 @elseif($plans['sku'] == '500 credit package')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <div class="pricing_box" onclick="handleClick('{{ $response['data'][$key]['id'] }}', '{{ $response['data'][$key]['price'] }}', '2')" data-id="{{ $response['data'][$key]['id'] }}">
                              <!-- <div class="offer_box">70% off</div> -->
                              <div class="pupular_plan">
                                <h6>{{ $plans['sku'] }}</h6>
                                <!-- <div class="pupular_btn"><img src="{{ URL::asset('public/front/img/download-fire.svg') }}"> Popular</div> -->
                              </div>
                              <h3>${{ number_format($plans['price'], 2) }} <span></span><small></small></h3>
                              <p></p>
                            </div>
                        </button>
                      </li>
                  @elseif($plans['sku'] == '1000 credit package')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <div class="pricing_box" onclick="handleClick('{{ $response['data'][$key]['id'] }}', '{{ $response['data'][$key]['price'] }}' , '2')" data-id="{{ $response['data'][$key]['id'] }}">
                              <!-- <div class="offer_box">70% off</div> -->
                              <div class="pupular_plan">
                                <h6>{{ $plans['sku'] }}</h6>
                                <!-- <div class="pupular_btn"><img src="{{ URL::asset('public/front/img/download-fire.svg') }}"> Popular</div> -->
                              </div>
                              <h3>${{ number_format($plans['price'], 2) }} <span></span><small></small></h3>
                              <p></p>
                            </div>
                        </button>
                      </li>
                  @endif
                @endforeach
              @endif
            </ul>
            <form action="{{ url('payment') }}" id="paymentForm" method="post">
            {!! csrf_field() !!}
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" >
                <!-- <div class="pay_btn" id="paypal">
                  <a href="#">Pay with <img src="{{ URL::asset('public/front/img/paypal.svg') }}"></a>
                </div> -->
                <div class="pay_btn" id="pay_creditcard">
                  <button type="submit" style="background: border-box;border: 0;color: white;"><img src="{{ URL::asset('public/front/img/credit-card.svg') }}" class="pe-1"> Pay with Credit / Debit Card</button>
                  <input type="hidden" id="productid" name="productid" value="4">
                  <input type="hidden" id="amount" name="amount" value="10.000">
                  <input type="hidden" id="billing_model" name="billing_model" value="2">
                  <input type="hidden" id="subscription_type" name="subscription_type" value="package">
                </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- <div class="pay_btn" id="paypal">
                  <a href="#">Pay with <img src="{{ URL::asset('public/front/img/paypal.svg') }}"></a>
                </div> -->
                <div class="pay_btn" id="pay_creditcard">
                <button type="submit" style="background: border-box;border: 0;color: white;"><img src="{{ URL::asset('public/front/img/credit-card.svg') }}" class="pe-1"> Pay with Credit / Debit Card</button>
                </div>
                <!-- <div class="pay_btn" id="pay_bitcoin">
                  <a href="#">Pay with <img src="{{ URL::asset('public/front/img/bitcoin.svg') }}" class="ps-1"> <img src="{{ URL::asset('public/front/img/eth.svg') }}"> <img src="{{ URL::asset('public/front/img/litecoin.svg') }}"></a>
                </div> -->
              </div>
            </div>
            </form>

            
              </div>
            </div>
       

            
          </div>
        </div>


        
        <div class="col-xl-4">
          <div class="discount_box">
            <div class="benefit">
              <h3>Premium Benefits</h3>
              <ul>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> More hot and steamy chat Unlock all girls</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Unlimited text messages</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Get 100 FREE tokens / month</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Remove image blur</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Generate NSFW images</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Listen to voice messages</li>
                <li><img src="{{ URL::asset('public/front/img/check_circle.svg') }}"> Fast response time</li>
              </ul>
              <img src="{{ URL::asset('public/front/img/manga_right.png') }}" class="d-none d-xl-block">
            </div>
          </div>
        </div>
      </div>
      <div class="position-absolute bottom-0 end-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="242" height="418" viewBox="0 0 242 475" fill="none">
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
<script>
  function showTime(){
  var date = new Date();
  var h = date.getHours(); // 0 - 23
  var m = date.getMinutes(); // 0 - 59
  var s = date.getSeconds(); // 0 - 59
  var session = "AM";
  
  if(h == 0){
      h = 12;
  }
  
  if(h > 12){
      h = h - 12;
  }
  
  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;
  
  var time = h + ":" + m + ":" + s + " " ;
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;
  
  setTimeout(showTime, 1000);
  
}

showTime();

</script>

<script>
    function handleClick(id, amount, bill, subscription) {
      // Set the value of #productid
      $('#productid').val(id);
      $('#amount').val(amount);
      $('#productid2').val(id);
      $('#amount2').val(amount);

      $('#subscription_type').val(subscription);
      $('#subscription_type2').val(subscription);

      $('#billing_model').val(bill);
      $('#billing_model2').val(bill);
     
      
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<?php if(empty($subscriptionsUser)) { ?>
  <script>
        // Wait for the DOM to be fully loaded
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Find the element with the ID "pills-profile-tab"
        //     var profileTab = document.getElementById('pills-profile-tab');
        //     var homeTab = document.getElementById('pills-home-tab');
        //     // Add a click event listener
        //     profileTab.addEventListener('click', function() {
        //      // Handle the click event here
        //      homeTab.click();
        //      Swal.fire({
        //             text: "Need Basic Subscription",
        //             icon: "info",
        //             confirmButtonText: "OK"
        //         }).then((result) => {
        //             // Additional action after clicking "OK"
        //             if (result.isConfirmed) {
        //                 // You can add your additional logic here
        //                 console.log("OK clicked");
        //                 homeTab.click();
                        
        //             }
        //         });
        //     });
        // });
        $('#pills-profile-tab').hide();
    </script>    
    
<?php } ?>
@include('front.layout.footer')