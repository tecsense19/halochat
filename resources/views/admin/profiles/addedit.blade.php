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
$profileList_first_message = isset($profileList->first_message) ? $profileList->first_message : '';
$voice_name = isset($profileList->voice_name) ? $profileList->voice_name : '';
$system_prompt = isset($profileList->system_prompt) ? $profileList->system_prompt : '';
$system_instruction = isset($profileList->system_instruction) ? $profileList->system_instruction : '';
$prompt = isset($profileList->prompt) ? $profileList->prompt : '';
$negative_prompt = isset($profileList->negative_prompt) ? $profileList->negative_prompt : '';
$profileListpersona = isset($profileList->personatype) ? $profileList->personatype : '';
$stability = isset($profileList->stability) ? $profileList->stability : '';
$subscription_type = isset($profileList->subscription_type) ? $profileList->subscription_type : '';
$similarity_boost = isset($profileList->similarity_boost) ? $profileList->similarity_boost : '';
$style = isset($profileList->style) ? $profileList->style : '';
$voice_id = isset($profileList->voice_id) ? $profileList->voice_id : '';
$voice_model = isset($profileList->voice_model) ? $profileList->voice_model : '';
$use_speaker_boost = isset($profileList->use_speaker_boost) ? $profileList->use_speaker_boost : '';
$max_ai_reply_length = isset($profileList->max_ai_reply_length) ? $profileList->max_ai_reply_length : '';
$max_prompt_length = isset($profileList->max_prompt_length) ? $profileList->max_prompt_length : '';
$short_description = isset($profileList->short_description) ? $profileList->short_description : '';
$image_prompt = isset($profileList->image_prompt) ? $profileList->image_prompt : '';

$imgUrl = isset($profileList->profileImages[0]['image_path']) ? asset('storage/app/public').'/'.$profileList->profileImages[0]['image_path'] : []; 
$get_voice = json_decode($get_voice, true);
// print_r($voice_name);
// die;
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
                                <label for="exampleSelectGender">Select Voice</label>
                                <select class="form-control" id="profile_get_voice" name="profile_get_voice" >
                                    @if ($get_voice !== null)
                                    @foreach ($get_voice['data'] as $item)
                                    <option data-audio-src="{{ $item['preview_url'] }}"
                                        data-profile-gender="{{ isset($item['labels']['gender']) ? $item['labels']['gender'] : '' }}"
                                        data-body-discription="{{ isset($item['labels']['description']) ? $item['labels']['description'] : '' }}"
                                        data-age="{{ isset($item['labels']['age']) ? $item['labels']['age'] : 0 }}"
                                        data-voice_id="{{ isset($item['voice_id']) ? $item['voice_id'] : '' }}">
                                        {{ $item['name'] }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <input type="hidden" name="voice_id" id="voice_id">
                            </div>
                            @error('profile_get_voice')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <audio id="audio-preview" name="audio_preview" controls>
                                    <source src="" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <input type="hidden" id="audio_url" name="audio_url" value="">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectpersonatype">Select persona Type</label>
                                <select class="form-control" id="profile_personatype" value="{{ $profileListpersona }}"
                                    name="profile_personatype">
                                    <option value="realistic" <?php if($profileListpersona == "realistic") { ?> selected
                                        <?php } ?>>Realistic</option>
                                    <option value="anime" <?php if($profileListpersona == "anime") { ?> selected
                                        <?php } ?>>Anime</option>
                                </select>
                            </div>
                            @error('profile_personatype')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="exampleSelectpersonatype">Select Subscription Type</label>
                                <select class="form-control" id="subscription_type" value="{{ $subscription_type }}"
                                    name="subscription_type">
                                    <option value="Basic subscription"
                                        <?php if($subscription_type == "Basic subscription") { ?> selected <?php } ?>>
                                        Basic subscription</option>
                                    <option value="VIP subscription"
                                        <?php if($subscription_type == "VIP subscription") { ?> selected <?php } ?>>VIP
                                        subscription</option>
                                </select>
                            </div>
                            @error('profile_personatype')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="systempromt">Context | (character cards, knowledge insertion, etc.)</label>
                                <textarea class="form-control custom-min-height" name="system_prompt" id="system_prompt"
                                    cols="30" rows="10" placeholder="System prompt">{{ $system_prompt }}</textarea>
                            </div>
                            @error('system_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="systempromt">Instruction</label>
                                <textarea class="form-control custom-min-height" name="system_instruction"
                                    id="system_instruction" cols="30" rows="10"
                                    placeholder="System instruction">{{ $system_instruction }}</textarea>

                            </div>
                            @error('system_instruction')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- <div class="form-group">
                                <label for="promt">Prompt</label>

                                <textarea class="form-control custom-min-height" name="prompt" id="prompt" cols="30" rows="10" placeholder="prompt">{{ $prompt }}</textarea>
                                
                            </div>
                            @error('prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror -->

                            <div class="form-group">
                                <label for="systempromt">Image prompt</label>
                                <textarea class="form-control custom-min-height" name="image_prompt"
                                    id="image_prompt" cols="30" rows="10"
                                    placeholder="Image prompt">{{ $image_prompt }}</textarea>

                            </div>
                            @error('image_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="negative_prompt">Negative prompt</label>
                                <textarea class="form-control custom-min-height" name="negative_prompt" id="negative_prompt" cols="30" rows="10" placeholder="Negative prompt">{{ $negative_prompt }}</textarea>
                            </div>
                            @error('negative_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                           

                            <div class="col-md-12 mt-4">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="range1">Stability</label>
                                            <input id="range1" name="stability" type="range" min="0.01" max="1" step="0.01" value="{{ $stability }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="range2">Similarity boost</label>
                                            <input id="range2" name="similarity_boost" type="range" min="0.01" max="1" step="0.01" value="{{ $similarity_boost }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="range3">Style</label>
                                            <input id="range3" name="style" type="range" min="0.01" max="1" step="0.01" value="{{ $style }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-check form-check-flat form-check-primary" bis_skin_checked="1">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="speakerBoostCheckbox" name="speakerBoostCheckbox" <?php if($use_speaker_boost == 1){ ?>checked <?php } else { ?> <?php }?>> Use Speaker Boost <i class="input-helper"></i></label>
                            </div>

                            <!-- <div class="form-group">
                                <label>Voice Model</label>
                                <select class="js-example-basic-single select2-hidden-accessible" style="width:100%" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="eleven_multilingual_v2" data-select2-id="3">Eleven Multilingual V2</option>
                                    <option value="eleven_monolingual_v1" data-select2-id="16">Eleven Monolingual V1</option>
                                </select>
                            </div> -->
                            

                            <div class="col-md-6">
                          <div class="form-group row">
                          
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" id="eleven_multilingual_v2" name="eleven_radio" value="eleven_multilingual_v2" <?php if($voice_model == "eleven_multilingual_v2") { ?> checked <?php } else{ ?> <?php } ?>  > Eleven Multilingual V2 </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" id="eleven_monolingual_v1" name="eleven_radio" value="eleven_monolingual_v1" <?php if($voice_model == "eleven_monolingual_v1") { ?> checked <?php } else{ ?> <?php } ?>  > Eleven Monolingual V1 </label>
                              </div>
                            </div>
                            </div>
                            </div>
                    
                     
                            
                            <div class="form-group">
                                <label for="voice_id">Voice id</label>
                                <input type="text" class="form-control" id="profile_voice_id" value="{{ $voice_id }}"
                                    name="profile_voice_id" placeholder="voice_id">
                            </div>

                            <div class="form-group">
                                <label for="voice_id">Max AI Reply Length</label>
                                <input type="text" class="form-control" id="max_ai_reply_length" value="{{ $max_ai_reply_length }}"
                                    name="max_ai_reply_length" placeholder="Max AI Reply Length">
                            </div>
                            @error('max_ai_reply_length')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="max_prompt_length">Max Prompt Length</label>
                                <input type="text" class="form-control" id="max_prompt_length" value="{{ $max_prompt_length }}"
                                    name="max_prompt_length" placeholder="Max Prompt Length">
                            </div>
                            @error('max_prompt_length')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <!-- <div class="form-group">
                                <label for="exampleSelectpersonatype">Voice Model</label>
                                <select class="form-control" id="voice_model" value="{{ $voice_model }}"
                                    name="voice_model" multiple>
                                    <option value="eleven_multilingual_v2"
                                        <?php if($voice_model == "eleven_multilingual_v2") { ?> selected <?php } ?>>
                                        Eleven Multilingual V2</option>
                                    <option value="eleven_monolingual_v1"
                                        <?php if($voice_model == "eleven_monolingual_v1") { ?> selected <?php } ?>>
                                        Eleven Monolingual V1</option>
                                </select>
                            </div> -->

                            <!-- <div class="form-group">
                                <label for="promt">Image Prompt</label>

                                <textarea class="form-control custom-min-height" name="prompt" id="prompt" cols="30" rows="10" placeholder="prompt">{{ $prompt }}</textarea>
                                
                            </div>
                            @error('prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            
                            <div class="form-group">
                                <label for="negative_prompt">Negative prompt</label>
                                <textarea class="form-control custom-min-height" name="negative_prompt" id="negative_prompt" cols="30" rows="10" placeholder="Negative prompt">{{ $negative_prompt }}</textarea>
                            </div>
                            @error('negative_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror -->

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
                                    <option value="male" <?php if($profileListGender == "male") { ?> selected
                                        <?php } ?>>Male</option>
                                    <option value="female" <?php if($profileListGender == "female") { ?> selected
                                        <?php } ?>>Female</option>
                                </select>
                            </div>
                            @error('profile_gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label>Profile image</label>
                                <input type="file" name="profile_img[]" id="fileInput" class="file-upload-default"
                                    multiple>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary check"
                                            type="button">Upload</button>
                                    </span>
                                </div>

                                <?php if ($imgUrl) { 
                                        foreach ($profileList->profileImages as $key => $value) { ?>
                                <img src="<?php echo asset('storage/app/public').'/'.$value['image_path']; ?>"
                                    height="100" width="100" alt="product_img"
                                    class="img-fluid site_setting_img_product">
                                <a class="btn btn-danger btn-rounded btn-icon remove-image" href="#"
                                    style="height: 20px;width: 20px;margin: 15px;"
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
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ $profileList_description }}" placeholder="Description">
                            </div>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <input type="text" class="form-control" id="short_description" value="{{ $short_description }}"
                                    name="short_description" placeholder="short_description">
                            </div>

                            <div class="form-group">
                                <label for="first_message">First message</label>
                                <input type="text" class="form-control" id="first_message" name="first_message"
                                    value="{{ $profileList_first_message }}" placeholder="first message">
                            </div>
                            @error('first_message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ redirect()->back()->getTargetUrl() }}"><button type="button"
                                    class="btn btn-dark">Cancel</button></a>
                        </form>
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
        var url = "{{ URL::to('admin/profiles/delete', [], true) }}"
        // var url = "{{ URL::to('admin/profiles/delete') }}"
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
    fileInput.addEventListener('change', function() {
        // Clear existing previews
        imagePreviewContainer.innerHTML = '';
        const files = fileInput.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create a container for the image preview
                    const imageContainer = document.createElement('div');
                    imageContainer.className = 'image-container';
                    // Create an image element for the preview
                    // Create an image element for the preview with width and height attributes
                    const imagePreview = document.createElement('img');
                    imagePreview.src = e.target.result;
                    imagePreview.setAttribute('width', '200'); // Set the desired width (e.g., 200 pixels)
                    imagePreview.setAttribute('height',
                        '150'); // Set the desired height (e.g., 150 pixels);
                    // Create a "Remove" button
                    // Create a "Remove" button
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'X';
                    removeButton.className =
                        'btn btn-danger btn-rounded btn-icon remove-image'; // Add your desired class
                    removeButton.style.height = '20px'; // Set the desired height
                    removeButton.style.width = '20px'; // Set the desired width
                    removeButton.style.margin = '15px'; // Set the desired margin
                    removeButton.addEventListener('click', function() {
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

    var voice_idIinput = document.getElementById('voice_id');
    var profile_voice_id = document.getElementById('profile_voice_id');
    

    

    selectElement.addEventListener('change', function() {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var audioSrc = selectedOption.getAttribute('data-audio-src');
        var dataprofile_ethnicity = selectedOption.getAttribute('data-age');
        var dataBodyDescription = selectedOption.getAttribute('data-body-discription');
        var dataGender = selectedOption.getAttribute('data-profile-gender');
        var voice_id = selectedOption.getAttribute('data-voice_id');
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
        voice_idIinput.value = voice_id;
        profile_voice_id.value = voice_id;
        audioPreview.load();
        audioPreview.play();
    });
</script>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        let range1 = new RollCounterRange("#range1"),
            range3 = new RollCounterRange("#range3"),
            range2 = new RollCounterRange("#range2");
    });
    class RollCounterRange {
    constructor(id) {
        this.el = document.querySelector(id);
        this.srValue = null;
        this.fill = null;
        this.digitCols = null;
        this.lastDigits = "";
        this.rollDuration = 0;
        this.maxValue = 0;

        if (this.el) {
            this.buildSlider();
            this.el.addEventListener("input", this.changeValue.bind(this));
        }
    }

    buildSlider() {
    // Calculate the number of steps based on the step size
    let numberOfSteps = Math.ceil((this.el.max - this.el.min) / this.el.step) + 1;
    // Set the max attribute based on the step size
    // this.el.max = this.el.min + (this.el.step * (numberOfSteps - 1));
    // create a div to contain the <input>
    let rangeWrap = document.createElement("div");
    rangeWrap.className = "range";
    this.el.parentElement.insertBefore(rangeWrap, this.el);
    // create another div to contain the <input> and fill
    let rangeInput = document.createElement("span");
    rangeInput.className = "range__input";
    rangeWrap.appendChild(rangeInput);
    // range fill, place the <input> and fill inside container <span>
    let rangeFill = document.createElement("span");
    rangeFill.className = "range__input-fill";
    rangeInput.appendChild(this.el);
    rangeInput.appendChild(rangeFill);
    // create the counter
    let counter = document.createElement("span");
    counter.className = "range__counter";
    rangeWrap.appendChild(counter);
    // screen reader value
    let srValue = document.createElement("span");
    srValue.className = "range__counter-sr";
    srValue.textContent = "0";
    counter.appendChild(srValue);

    // Modify the loop to create columns based on the number of steps
    for (let i = 0; i < numberOfSteps; i++) {
        let digitCol = document.createElement("span");
        digitCol.className = "range__counter-column";
        digitCol.setAttribute("aria-hidden", "true");
        counter.appendChild(digitCol);

        // digits (blank, 0–9, fake 0)
        for (let d = 0; d <= 11; ++d) {
            let digit = document.createElement("span");
            digit.className = "range__counter-digit";
            if (d > 0) {
                // Adjust the content based on the minimum value
                digit.textContent = d == 11 ? (this.el.min + this.el.step * i) : `${d - 1}`;
            }
            digitCol.appendChild(digit);
        }
    }

    this.srValue = srValue;
    this.fill = rangeFill;
    this.digitCols = counter.querySelectorAll(".range__counter-column");
    this.lastDigits = this.el.value;
    while (this.lastDigits.length < this.digitCols.length)
        this.lastDigits = " " + this.lastDigits;
    this.changeValue();

    // Use the transition duration from CSS
    let colCS = window.getComputedStyle(this.digitCols[0]),
        transDur = colCS.getPropertyValue("transition-duration"),
        msLabelPos = transDur.indexOf("ms"),
        sLabelPos = transDur.indexOf("s");
    if (msLabelPos > -1)
        this.rollDuration = transDur.substr(0, msLabelPos);
    else if (sLabelPos > -1)
        this.rollDuration = transDur.substr(0, sLabelPos) * 1e3;
}

        changeValue() {
            // keep the value within range
            if (+this.el.value > this.el.max)
                this.el.value = this.el.max;
            else if (+this.el.value < this.el.min)
                this.el.value = this.el.min;
            // update the screen reader value
            if (this.srValue)
                this.srValue.textContent = this.el.value;
            // width of fill
            if (this.fill) {
                let pct = this.el.value / this.el.max,
                    fillWidth = pct * 100,
                    thumbEm = 1 - pct;
                this.fill.style.width = `calc(${fillWidth}% + ${thumbEm}em)`;
            }
            if (this.digitCols) {
                let rangeVal = this.el.value;
                // add blanks at the start if needed
                while (rangeVal.length < this.digitCols.length)
                    rangeVal = " " + rangeVal;
                // get the differences between current and last digits
                let diffsFromLast = [];
                if (this.lastDigits) {
                    rangeVal.split("").forEach((r, i) => {
                        let diff = +r - this.lastDigits[i];
                        diffsFromLast.push(diff);
                    });
                }
                // roll the digits
                this.trans09 = false;
                rangeVal.split("").forEach((e, i) => {
                    let digitH = 1.5,
                        over9 = false,
                        under0 = false,
                        transY = e === " " ? 0 : (-digitH * (+e + 1)),
                        col = this.digitCols[i];
                    // start handling the 9-to-0 or 0-to-9 transition
                    if (e == 0 && diffsFromLast[i] == -9) {
                        transY = -digitH * 11;
                        over9 = true;
                    } else if (e == 9 && diffsFromLast[i] == 9) {
                        transY = 0;
                        under0 = true;
                    }
                    col.style.transform = `translateY(${transY}em)`;
                    col.firstChild.textContent = "";
                    // finish the transition
                    if (over9 || under0) {
                        this.trans09 = true;
                        // add a temporary 9
                        if (under0)
                            col.firstChild.textContent = e;
                        setTimeout(() => {
                            if (this.trans09) {
                                let pauseClass = "range__counter-column--pause",
                                    transYAgain = -digitH * (over9 ? 1 : 10);
                                col.classList.add(pauseClass);
                                col.style.transform = `translateY(${transYAgain}em)`;
                                void col.offsetHeight;
                                col.classList.remove(pauseClass);
                                // remove the 9
                                if (under0)
                                    col.firstChild.textContent = "";
                            }
                        }, this.rollDuration);
                    }
                });
                this.lastDigits = rangeVal;
            }
        }
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var speakerBoostCheckbox = document.getElementById("speakerBoostCheckbox");

        if (speakerBoostCheckbox) {
            // Add an event listener for the change event
            speakerBoostCheckbox.addEventListener("change", function(event) {
                if (event.target.checked) {
                    // Checkbox is checked
                    var value = speakerBoostCheckbox.checked ? 1 : 0;
                    console.log("Checkbox is checked");
                } else {
                    // Checkbox is unchecked
                    console.log("Checkbox is unchecked");
                }
            });
        }
    });
</script>

@include('admin.layout.footer')