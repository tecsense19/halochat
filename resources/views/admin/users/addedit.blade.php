<?php

$name = isset($userList->name) ? $userList->name : '';
$email = isset($userList->email) ? $userList->email : '';
$gender = isset($userList->gender) ? $userList->gender : '';
$google_id = isset($userList->google_id) ? $userList->google_id : '';
$chatuser_id = isset($userList->chatuser_id) ? $userList->chatuser_id : '';
$user_avatar = isset($userList->user_avatar) ? $userList->user_avatar : '';
$role = isset($userList->role) ? $userList->role : '';
$plans = isset($userList->plans) ? $userList->plans : '';
$status = isset($userList->status) ? $userList->status : '';
$contact_us = isset($userList->contact_us) ? $userList->contact_us : '';
$created_at = isset($userList->created_at) ? $userList->created_at : '';
$updated_at = isset($userList->updated_at) ? $userList->updated_at : '';
$deleted_at = isset($userList->deleted_at) ? $userList->deleted_at : '';


?>
@include('admin.layout.header')

<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">

    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.layout.front')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        <p class="card-description"> Add-Edit Users </p>
                        <form class="forms-sample" action="{{ route('admin.users.store') }}" method="POST"
                            enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $name }}" name="name" placeholder="Name">
                                    <input type="hidden" value="{{ $id }}" name="id">
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" 
                                    value="{{ $email }}" name="email" placeholder="Email">
                                
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <div class="form-group">
                                <label for="exampleSelectGender">Gender</label>
                                <select class="form-control" id="gender" value="{{ $gender }}"
                                    name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            

                            <div class="form-group">
                                <label for="gid">Google id</label>
                                <input type="text" class="form-control" id="google_id" 
                                    value="{{ $google_id }}" name="google_id" placeholder="google id">
                                
                            </div>
                            @error('google_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <div class="form-group">
                                <label for="email">Chat id</label>
                                <input type="text" class="form-control" id="chatuser_id" 
                                    value="{{ $chatuser_id }}" name="chatuser_id" placeholder="chatuser_id">
                                
                            </div>
                            @error('chatuser_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="gender" value="{{ $role }}"
                                    name="role">

                                    <option value="Admin" <?php if($role == "Admin") { ?> selected <?php } ?> >Admin</option>
                                    <option value="User" <?php if($role == "User") { ?> selected <?php } ?>>User</option>  
                                </select>
                                @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                           


                            <div class="form-group">
                                <label for="role">Plans</label>
                                <select class="form-control" id="plans" value="{{ $plans }}"
                                    name="plans">
                                    <option value="Free" <?php if($plans == "Free") { ?> selected <?php } ?>>Free</option>
                                    <option value="premium" <?php if($plans == "premium") { ?> selected <?php } ?>>premium</option>
                                </select>
                                @error('plans')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                         


                            <div class="form-group">
                                <label for="role">Status</label>
                                <select class="form-control" id="status" value="{{ $status }}"
                                    name="status">
                                    <option value="Active" <?php if($status == "Active") { ?> selected <?php } ?> >Active</option>
                                    <option value="Suspend" <?php if($status == "Suspend") { ?> selected <?php } ?>>Suspend</option>
                                </select>

                                @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                       

                            

                            <div class="form-group">
                                <label for="email">Feedback Message</label>
                                <input type="text" class="form-control" id="contact_us" 
                                    value="{{ $contact_us }}" name="contact_us" placeholder="contact us">
                                    @error('contact_us')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        


                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('admin.users') }}"></a><button class="btn btn-dark">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@include('admin.layout.footer')