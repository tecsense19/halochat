<?php 
$id = isset($profilegloble->id) ? $profilegloble->id : '';
$globle_realistic_prompts = isset($profilegloble->globle_realistic_prompts) ? $profilegloble->globle_realistic_prompts : '';
$globle_anime_prompts = isset($profilegloble->globle_anime_prompts) ? $profilegloble->globle_anime_prompts : '';
$globle_anime_terms = isset($profilegloble->globle_anime_terms) ? $profilegloble->globle_anime_terms : '';
$globle_realistic_terms = isset($profilegloble->globle_realistic_terms) ? $profilegloble->globle_realistic_terms : '';
$restore_faces = isset($profilegloble->restore_faces) ? $profilegloble->restore_faces : '';
$seed = isset($profilegloble->seed) ? $profilegloble->seed : '';
$denoising_strength = isset($profilegloble->denoising_strength) ? $profilegloble->denoising_strength : '';
$enable_hr = isset($profilegloble->enable_hr) ? $profilegloble->enable_hr : '';
$hr_scale = isset($profilegloble->hr_scale) ? $profilegloble->hr_scale : '';
$hr_upscaler = isset($profilegloble->hr_upscaler) ? $profilegloble->hr_upscaler : '';
$sampler_index = isset($profilegloble->sampler_index) ? $profilegloble->sampler_index : '';
$email = isset($profilegloble->email) ? $profilegloble->email : '';
$steps = isset($profilegloble->steps) ? $profilegloble->steps : '';
$prompt_Url = isset($profilegloble->prompt_Url) ? $profilegloble->prompt_Url : '';
$globle_realistic_nagative_prompt = isset($profilegloble->globle_realistic_nagative_prompt) ? $profilegloble->globle_realistic_nagative_prompt : '';
$wordsphrases = isset($profilegloble->wordsphrases) ? $profilegloble->wordsphrases : '';
$cfg_scale = isset($profilegloble->cfg_scale) ? $profilegloble->cfg_scale : '';

?>
@if ($errors->has('ai_persona'))
    <script>
        // Display an alert message using JavaScript
        alert("{{ $errors->first('ai_persona') }}");
    </script>
@endif

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
                        <h4 class="card-title">Globle Realistic prompts</h4>
                        <p class="card-description"> Add-Edit Globle Realistic prompts </p>
                        <form class="forms-sample" action="{{ route('admin.profile.store_globleprompts') }}" method="POST"
                            enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Name">Globle Realistic Prompts</label>

                                <textarea class="form-control custom-min-height" name="globle_realistic_prompts" id="globle_realistic_prompts" cols="30" rows="10" placeholder="Globle Realistic Prompts">{{ $globle_realistic_prompts }}</textarea>
                                    <input type="hidden" value="realistic" name="type"> 
                                    @error('globle_realistic_prompts')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                          
                         
                            <div class="form-group">
                                <label for="Name">Globle Realistic Terms</label>
                                <textarea class="form-control custom-min-height" name="globle_realistic_terms" id="globle_realistic_terms" cols="30" rows="10" placeholder="Globle Realistic Terms">{{ $globle_realistic_terms }}</textarea>
                                
                                    @error('globle_realistic_terms')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">Globle Realistic nagative prompt</label>
                                <textarea class="form-control custom-min-height" name="globle_realistic_nagative_prompt" id="globle_realistic_nagative_prompt" cols="30" rows="10" placeholder="Globle Realistic Terms">{{ $globle_realistic_nagative_prompt }}</textarea>
                                    @error('globle_anime_nagative_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">List of words and phrases</label>
                                <textarea class="form-control custom-min-height" name="wordsphrases" id="wordsphrases" cols="30" rows="10" placeholder="Words and phrases">{{ $wordsphrases }}</textarea>
                                    @error('wordsphrases')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="Name">Globle Realistic Url</label>
                                <input type="text" class="form-control" id="prompt_Url" id="prompt_Url"
                                    value="{{ $prompt_Url }}" name="prompt_Url" placeholder="Globle Anime Url">
                            </div>
                            @error('prompt_Url')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror -->
                         

                            <div class="form-group">
                                <label for="Name">Restore faces</label>
                                <input type="text" class="form-control" id="restore_faces" id="restore_faces"
                                    value="{{ $restore_faces }}" name="restore_faces" placeholder="Restore faces">
                                    @error('restore_faces')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">Seed</label>
                                <input type="text" class="form-control" id="seed" id="seed"
                                    value="{{ $seed }}" name="seed" placeholder="Seed">
                                    @error('seed')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">Cfg scale</label>
                                <input type="text" class="form-control" id="cfg_scale" id="cfg_scale"
                                    value="{{ $cfg_scale }}" name="cfg_scale" placeholder="cfg_scale">
                                    @error('cfg_scale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">denoising_strength</label>
                                <input type="text" class="form-control" id="denoising_strength" id="denoising_strength"
                                    value="{{ $denoising_strength }}" name="denoising_strength" placeholder="denoising_strength">
                                    @error('denoising_strength')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">enable_hr</label>
                                <input type="text" class="form-control" id="enable_hr" id="enable_hr"
                                    value="{{ $enable_hr }}" name="enable_hr" placeholder="enable_hr">
                                    @error('enable_hr')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>



                            <div class="form-group">
                                <label for="Name">hr_scale</label>
                                <input type="text" class="form-control" id="hr_scale" id="hr_scale"
                                    value="{{ $hr_scale }}" name="hr_scale" placeholder="hr_scale">
                                    @error('hr_scale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">hr_upscaler</label>
                                <input type="text" class="form-control" id="hr_upscaler" id="hr_upscaler"
                                    value="{{ $hr_upscaler }}" name="hr_upscaler" placeholder="hr_upscaler">
                                    @error('hr_upscaler')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">sampler_index</label>
                                <input type="text" class="form-control" id="sampler_index" id="sampler_index"
                                    value="{{ $sampler_index }}" name="sampler_index" placeholder="sampler_index">
                                    @error('sampler_index')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">email</label>
                                <input type="text" class="form-control" id="email" id="email"
                                    value="{{ $email }}" name="email" placeholder="email">
                                    @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>


                            <div class="form-group">
                                <label for="Name">steps</label>
                                <input type="text" class="form-control" id="steps" id="steps"
                                    value="{{ $steps }}" name="steps" placeholder="steps">
                                    @error('steps')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ redirect()->back()->getTargetUrl() }}"><button type="button" class="btn btn-dark">Cancel</button></a>
                            </form> 
                           

                            <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Globle Realistic prompts</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Globle Realistic Prompts</th>
                                                        <th>Globle Realistic Terms</th>
                                                        <th>prompt_Url</th>
                                                        <th>restore_faces</th>
                                                        <th>seed</th>
                                                        <th>denoising_strength</th>
                                                        <th>enable_hr</th>
                                                        <th>hr_scale</th>
                                                        <th>hr_upscaler</th>
                                                        <th>sampler_index</th>
                                                        <th>email</th>
                                                        <th>steps</th>
                                                        <th>Updated date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <td>1</td>
                                                <td>{{ $globle_realistic_prompts }}</td>
                                                <td>{{ $globle_realistic_terms }}</td>
                                                <td>{{ $prompt_Url }}</td>
                                                <td>{{ $restore_faces }}</td>
                                                <td>{{ $seed }}</td>
                                                <td>{{ $denoising_strength }}</td>
                                                <td>{{ $enable_hr }}</td>
                                                <td>{{ $hr_scale }}</td>
                                                <td>{{ $hr_upscaler }}</td>
                                                <td>{{ $sampler_index }}</td>
                                                <td>{{ $email }}</td>
                                                <td>{{ $steps }}</td>
                                                <td>{{ isset($profilegloble->updated_at) ? $profilegloble->updated_at : '' }}</td>
                                                </tbody>
                                            
                                            </table>
                                        
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


<script>
        var selectElement = document.getElementById('profile_get_voice');
        var audioPreview = document.getElementById('audio-preview');
        var profile_ethnicity = document.getElementById('profile_ethnicity');
        var body_description = document.getElementById('profile_body_description');
        var profile_gender = document.getElementById('profile_gender');
        var audioUrlInput = document.getElementById('audio_url');
        
    

        selectElement.addEventListener('change', function () {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var audioSrc = selectedOption.getAttribute('data-audio-src');
        var dataprofile_ethnicity = selectedOption.getAttribute('data-age');
        var dataBodyDescription = selectedOption.getAttribute('data-body-discription');
        var dataGender = selectedOption.getAttribute('data-profile-gender');

        

        if (dataprofile_ethnicity !== null) {
            profile_ethnicity.value = dataprofile_ethnicity;
        } else {
            profile_age.value = 'Age information not available';
        }

        if (dataBodyDescription !== null) {
            body_description.value = dataBodyDescription;
        } else {
            body_description.value = 'Body description not available';
        }

        if (dataGender !== null) {
            profile_gender.value = dataGender;
        } else {
            profile_gender.value = 'Gender information not available';
        }

        audioPreview.src = audioSrc;
        audioUrlInput.value = audioSrc;
        audioPreview.load();
        audioPreview.play();
});

</script>



@include('admin.layout.footer')