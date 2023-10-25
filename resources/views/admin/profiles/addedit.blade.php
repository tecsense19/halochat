<?php 

$profile_id = isset($profileList->profile_id) ? $profileList->profile_id : '';
$profileListName = isset($profileList->name) ? $profileList->name : '';
$profileListEthnicity = isset($profileList->ethnicity) ? $profileList->ethnicity : '';
$profileListPersonality = isset($profileList->personality) ? $profileList->personality : '';
$profileListAge = isset($profileList->age) ? $profileList->age : '';
$profileListGender = isset($profileList->gender) ? $profileList->gender : '';
$profileListOccupation = isset($profileList->occupation) ? $profileList->occupation : '';
$profileListHobbies = isset($profileList->hobbies) ? $profileList->hobbies : '';
$profileListRelationship_status = isset($profileList->hobbies) ? $profileList->hobbies : '';
$profileListBody_description = isset($profileList->body_description) ? $profileList->body_description : '';
$profileList_description = isset($profileList->description) ? $profileList->description : '';

$imgUrl = isset($profileList->profileImages[0]['image_path']) ? asset('storage/app/public').'/'.$profileList->profileImages[0]['image_path'] : []; 
?>
<style>
button.file-upload-browse.btn.btn-primary {
    margin: 5px;
}
.image-container {
    margin: 10px;
    display: inline-block;
    text-align: center;
}

button {
    display: block;
    margin: 5px auto;
}

</style>
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
                        <h4 class="card-title">Profiles</h4>
                        <p class="card-description"> Add-Edit Profiles </p>
                        <form class="forms-sample" action="{{ route('admin.profile.store') }}" method="POST"
                            enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" id="profile_name"
                                    value="{{ $profileListName }}" name="profile_name" placeholder="Name">
                                <input type="hidden" value="{{ $profile_id }}" name="profile_id">
                            </div>
                            @error('profile_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="ethnicity">Ethnicity</label>
                                <input type="text" class="form-control" id="profile_ethnicity" name="profile_ethnicity"
                                    value="{{ $profileListEthnicity }}" placeholder="ethnicity">
                            </div>
                            @error('profile_ethnicity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="personality">Personality</label>
                                <input type="text" class="form-control" id="profile_personality"
                                    name="profile_personality" value="{{ $profileListPersonality }}"
                                    placeholder="personality">
                            </div>
                            @error('profile_personality')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" class="form-control" id="profile_age" value="{{ $profileListAge }}"
                                    name="profile_age" placeholder="age">
                            </div>
                            @error('profile_age')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="exampleSelectGender">Gender</label>
                                <select class="form-control" id="profile_gender" value="{{ $profileListGender }}"
                                    name="profile_gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            @error('profile_gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label>Profile image</label>
                                <input type="file" name="profile_img[]" id="fileInput" class="file-upload-default"
                                    multiple >
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                
                                <?php if ($imgUrl) { 
                                        foreach ($profileList->profileImages as $key => $value) { ?>
                                    <img src="<?php echo asset('storage/app/public').'/'.$value['image_path']; ?>" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <a class="btn btn-danger btn-rounded btn-icon remove-image" href="#" style="height: 20px;width: 20px;margin: 15px;"
                                        data-image="<?php echo $value['image_path'];?>"
                                        data-id="<?php echo $profile_id; ?>">&#215;</a>
                                    <?php
                                } 
                            }?>
                            </div>
                            <div id="imagePreviewContainer"></div>


                            @error('profile_img')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="profile_occupation">Occupation</label>
                                <input type="text" class="form-control" id="profile_occupation"
                                    value="{{ $profileListOccupation }}" name="profile_occupation"
                                    placeholder="occupation">
                            </div>
                            @error('profile_occupation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="profile_hobbies">Hobbies</label>
                                <input type="text" class="form-control" id="profile_hobbies"
                                    value="{{ $profileListHobbies }}" name="profile_hobbies" placeholder="hobbies">
                            </div>
                            @error('profile_hobbies')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="relationship_status">Relationship status</label>
                                <input type="text" class="form-control" id="profile_relationship_status"
                                    name="profile_relationship_status" value="{{ $profileListRelationship_status }}"
                                    placeholder="relationship status">
                            </div>
                            @error('profile_relationship_status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="body_description">Body description</label>
                                <input type="text" class="form-control" id="profile_body_description"
                                    name="profile_body_description" value="{{ $profileListBody_description }}"
                                    placeholder="Body description">
                            </div>
                            @error('profile_body_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="body_description"
                                    name="profile_description" value="{{ $profileList_description }}"
                                    placeholder="Body description">
                            </div>
                            @error('profile_body_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror



                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-dark">Cancel</button>
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

<script>
        $(document).ready(function() {
            // Your code that needs to run when the document is ready
            // For example, you can add event listeners or manipulate the DOM here
        });

        
    $('.remove-image').click(function(e) {
      
        var url = "{{ URL::to('admin/profiles/delete') }}"

        e.preventDefault();
      var container = $(this).closest('.image-container');
      //var imageId = container.find('.image-id').val(); delete_partner_img
      var image_path = $(this).data('image');

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
                url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include the CSRF token
                        image_path: image_path
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
});
</script>



<script>
const fileInput = document.getElementById('fileInput');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');

fileInput.addEventListener('change', function () {
    // Clear existing previews
    imagePreviewContainer.innerHTML = '';

    const files = fileInput.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Create a container for the image preview
                const imageContainer = document.createElement('div');
                imageContainer.className = 'image-container';

                // Create an image element for the preview
                // Create an image element for the preview with width and height attributes
                const imagePreview = document.createElement('img');
                imagePreview.src = e.target.result;
                imagePreview.setAttribute('width', '200'); // Set the desired width (e.g., 200 pixels)
                imagePreview.setAttribute('height', '150'); // Set the desired height (e.g., 150 pixels);


                // Create a "Remove" button
                // Create a "Remove" button
                const removeButton = document.createElement('button');
                removeButton.textContent = 'X';
                removeButton.className = 'btn btn-danger btn-rounded btn-icon remove-image'; // Add your desired class
                removeButton.style.height = '20px'; // Set the desired height
                removeButton.style.width = '20px'; // Set the desired width
                removeButton.style.margin = '15px'; // Set the desired margin
                removeButton.addEventListener('click', function () {
                    // Remove the image container when the "Remove" button is clicked
                    imageContainer.remove();
                    // Remove the corresponding file from the input field
                    const newFiles = new DataTransfer();
                    for (let j = 0; j < files.length; j++) {
                        if (files[j] !== file) {
                            newFiles.items.add(files[j]);
                        }
                    }
                    fileInput.files = newFiles.files;
                });

                // Append the image and the "Remove" button to the container
                imageContainer.appendChild(imagePreview);
                imageContainer.appendChild(removeButton);

                // Append the image container to the preview container
                imagePreviewContainer.appendChild(imageContainer);
            };
            reader.readAsDataURL(file);
        }
    }
});


</script>



@include('admin.layout.footer')