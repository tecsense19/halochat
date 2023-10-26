
@include('front.layout.front')
@include('front.layout.header')
<style>
    input[type="text"] {
    color: white;
}
input[type="password"] {
    color: white;
}
</style>
<main id="main">
    <section class="profile_setting">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-md-6">
            <div class="profile_content_box">
              <div class="profile_title">
                <h2>Profile Settings</h2>
              </div>
              <div class="admin_profile_box">
                <div class="admin_details">
                  <div class="row">
                    <div class="col-lg-3 col-12">
                      <div class="admin_img">
                        <img src="{{ URL::asset('public/front/img/man.svg') }}">
                      </div>
                    </div>
                    <div class="col-lg-5 col-6">
                      <div class="admin_name">
                        <div class="nickname">
                          <h5>Nickname</h5>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#How_to_use"><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>{{ $user->name }}</h6>
                      </div>
                      <input type="hidden" value="{{ $user->id }}" name="id" id="id">
                      <div class="admin_name mb-0">
                        <div class="nickname">
                          <h5>E-mail</h5>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#How_to_use_email"><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>{{ $user->email }}</h6>
                      </div>
                    </div>
                    <div class="col-lg-4 col-6">
                      <div class="admin_name">
                        <div class="nickname">
                          <h5>Gender</h5>
                          <a href="#"><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>{{ $user->gender }}</h6>
                      </div>
                      <div class="admin_name mb-0">
                        <div class="nickname">
                          <h5>Password </h5>
                          <a href="#"data-bs-toggle="modal" data-bs-target="#How_to_use_password"><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>********</h6>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="admin_details">
                  <h3>Automatic Notifications</h3>
                  <div class="checkbox_circle">
                    <input type="checkbox" name="checkbox" checked>
                    <label>As a user, you will receive automatic notifications from us. If you dont want any notifications, uncheck the box by clicking on it.</label>
                  </div>
                </div>
                <div class="admin_details">
                  <h3>Danger Zone</h3>
                  <p>If you want to permanently delete this account and all of its data, click button below. </p>
                  <a href="#" class="delete_btn"><img src="{{ URL::asset('public/front/img/delete.svg') }}"> Delete Account</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-md-6 ">
            <div class="current_plan_box">
              <div class="current_plan_txt">
                <h6>Current Plan <span>Free</span></h6>
                <a href="{{ route('subscription.subscription') }}" class="change_plan_btn">Change Plan</a>
              </div>
              <div class="current_plan_txt" id="pay_txt">
                <p>Payment date: <span>19.10.23</span></p>
                <p>Subscription to: <span>19.11.23</span></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>
  <!-- End #main -->



  <div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="How_to_use" tabindex="-1" aria-labelledby="How_to_useModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="color: white;font-size: 22px;">Edit Nickname and Gender</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="contact_details">
                        <input type="text" placeholder="Nickname" value="{{ $user->name }}" name="nickname" id="nicknameInput">
                    </div>
                    <div class="contact_details">
                        <button type="submit"  class="name_update">Save Changes</button>
                        <!-- <span>By signing up, you agree to <a href="#">Terms of Service</a></span> -->
                    </div>
                    </from> 
                </div>
            </div>
        </div>
    </div>
</div>



<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="How_to_use_email" tabindex="-1" aria-labelledby="How_to_useModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="color: white;font-size: 22px;">Edit Email address</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="contact_details">
                        <input type="text" placeholder="email" value="{{ $user->email }}" name="email">
                    </div>
                    <div class="contact_details">
                        <button type="submit">Save Changes</button>
                        <!-- <span>By signing up, you agree to <a href="#">Terms of Service</a></span> -->
                    </div>
                    </from> 
                </div>
            </div>
        </div>
    </div>
</div>



<div class="how_to_use_popup">
    <!-- Modal -->
    <div class="modal fade" id="How_to_use_password" tabindex="-1" aria-labelledby="How_to_useModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="color: white;font-size: 22px;">Edit Password</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="contact_details">
                        <input type="password" placeholder="Current password" value="********" name="password">
                    </div>
                    <div class="contact_details">
                        <input type="password" placeholder="New password" value="" name="password">
                    </div>
                    <div class="contact_details">
                        <button type="submit">Save Changes</button>
                        <!-- <span>By signing up, you agree to <a href="#">Terms of Service</a></span> -->
                    </div>
                    </from> 
                </div>
            </div>
        </div>
    </div>
</div>
@include('front.layout.footer')