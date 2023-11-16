@include('front.layout.front')
@include('front.layout.header')

<?php 

$user = isset($user) ? $user : '';
$userName = isset($user->name) ? $user->name : '';
$userId = isset($user->id) ? $user->id : '';
$userEmail = isset($user->email) ? $user->email : '';
$userPassword = isset($user->password) ? $user->password : '';
$userGender = isset($user->gender) ? $user->gender : '';
$userGender = isset($user->gender) ? $user->gender : '';
$userCreated_at = isset($user->created_at) ? $user->created_at : '';
$dateString = $userCreated_at; // Replace with your date string
$timestamp = strtotime($dateString);
$formattedDate = date('Y-m-d', $timestamp);
$currentcredit = isset($managecredit->currentcredit) ? $managecredit->currentcredit : '';

?>

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
                        <img src="{{ URL::asset('public/front/img/man-pur.svg') }}">
                      </div>
                    </div>
                    <div class="col-lg-5 col-6">
                      <div class="admin_name">
                        <div class="nickname">
                          <h5>Nickname</h5>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#edit" ><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>{{ $userName }}</h6>
                      </div>
                      <input type="hidden" value="{{ $userId }}" name="id" id="id">
                      <div class="admin_name mb-0">
                        <div class="nickname">
                          <h5>E-mail</h5>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#edit" ><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>{{ $userEmail }}</h6>
                      </div>
                    </div>
                    <div class="col-lg-4 col-6">
                      <div class="admin_name">
                        <div class="nickname">
                          <h5>Gender</h5>
                          <a href="#"><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
                        </div>
                        <h6>{{ $userGender }}</h6>
                      </div>
                      <div class="admin_name mb-0">
                        <div class="nickname">
                          <h5>Password </h5>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#edit" ><img src="{{ URL::asset('public/front/img/edit.svg') }}"></a>
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
                  <a href="" class="delete_btn" id="deleteAccountBtn"><img src="{{ URL::asset('public/front/img/delete.svg') }}"> Delete Account</a>
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
                <p>Payment date: <span>{{ $formattedDate }}</span></p>
                <p>Subscription <span>{{ $currentcredit }} Credit</span></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>
  <!-- End #main -->


  
  <!-- Modal -->
<div class="edit_popup">
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Edit Nickname and Gender</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="edit_details">
          <form action="{{ route('profile.update') }}" method="post">
                {!! csrf_field() !!}
              <div class="edit_txt">
                <input type="text" name="name" value="{{ $userName }}" placeholder="Your Name">
                <p class="edit_icon_left"><img src="{{ URL::asset('public/front/img/user.svg') }}" width="20"></p>
              </div>
              <div class="edit_txt">
                <input type="text" name="email" value="{{ $userEmail }}" placeholder="Your E-mail">
                <p class="edit_icon_left"><img src="{{ URL::asset('public/front/img/filled-email.svg') }}" width="20"></p>
              </div>
              <div class="edit_txt">
                <input type="text" name="" value="********" placeholder="Old Password">
                <input type="hidden" name="password" value="{{ $userPassword }}" placeholder="Old Password">
                <p class="edit_icon_left"><img src="{{ URL::asset('public/front/img/lock.svg') }}" width="20"></p>
                <p class="edit_icon_right"><img src="{{ URL::asset('public/front/img/eye.svg') }}" width="20"></p>
              </div>
              <div class="edit_txt">
                <input type="password" name="Newpassword" id="passwordField" value="" placeholder="New Password">
                <p class="edit_icon_left"><img src="{{ URL::asset('public/front/img/lock.svg') }}" width="20"></p>
                <p class="edit_icon_right" ><img src="{{ URL::asset('public/front/img/eye.svg') }}" width="20" id="showPassword"></p>
              </div>
              <div class="edit_txt">
                <select name="gender" id="genderDropdown">
                  <option value="">Gender</option>
                  <option selected="selected" value="{{ $userGender }}">{{ $userGender }}</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="edit_txt">
                <button type="submit">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@include('front.layout.footer')

<script>
  const passwordField = document.getElementById('passwordField');
    const showPassword = document.getElementById('showPassword');

    showPassword.addEventListener('mouseover', function () {
        passwordField.type = 'text';
    });

    showPassword.addEventListener('mouseout', function () {
        passwordField.type = 'password';
});

</script>
<script>
$(document).ready(function() {
    var uniqueValues = [];
    $("#genderDropdown option").each(function() {
        var optionValue = $(this).val();
        if (uniqueValues.includes(optionValue)) {
            $(this).remove();
        } else {
            uniqueValues.push(optionValue);
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // Get a reference to the "Delete Account" button
    const deleteAccountBtn = document.getElementById('deleteAccountBtn');

    // Add a click event listener to the button
    deleteAccountBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default behavior (following the href)

        // Here, you can add code to display a confirmation dialog or perform the delete action
        if (confirm('Are you sure you want to delete your account and all its data?')) {

          axios.post("{{ route('profile.delete') }}") // Replace with the actual delete account endpoint
                .then(function (response) {
                    // Handle the response from the server, e.g., show a success message
                    alert('Account deleted successfully.');
                    window.location.href = "{{ route('logout') }}";
                })
                .catch(function (error) {
                    // Handle errors, e.g., show an error message
                    alert('Error deleting the account.');
                    console.error(error);
                });
        } else {
            // If the user cancels, you can do nothing or provide feedback
            alert('Account deletion canceled.');
        }
    });
</script>