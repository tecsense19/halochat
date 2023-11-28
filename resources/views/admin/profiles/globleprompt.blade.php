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
                        <h4 class="card-title">Globle Anime prompts</h4>
                        <p class="card-description"> Add-Edit Globle Anime prompts </p>
                        <form class="forms-sample" action="{{ route('admin.profile.store_globleprompts') }}" method="POST"
                            enctype="multipart/form-data">
                            {!! csrf_field() !!}
                
                          
                            
                            <div class="form-group">
                                <label for="Name">Globle Anime Prompts</label>
                                <textarea class="form-control custom-min-height" name="globle_anime_prompts" id="globle_anime_prompts" cols="30" rows="10" placeholder="Globle Anime Prompts">{{ $globle_anime_prompts }}</textarea>
                               
                                    <input type="hidden" value="anime" name="type"> 
                            </div>
                            @error('globle_anime_prompts')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                         

                            <div class="form-group">
                                <label for="Name">Globle Anime Terms</label>
                                <textarea class="form-control custom-min-height" name="globle_anime_terms" id="globle_anime_terms" cols="30" rows="10" placeholder="Globle Anime Terms">{{ $globle_anime_terms }}</textarea>
                                    @error('globle_anime_terms')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">Globle Anime Url</label>
                                <input type="text" class="form-control" id="prompt_Url" id="prompt_Url"
                                    value="{{ $prompt_Url }}" name="prompt_Url" placeholder="Globle Anime Url">
                            </div>
                            @error('prompt_Url')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

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
                                <label for="Name">Denoising strength</label>
                                <input type="text" class="form-control" id="denoising_strength" id="denoising_strength"
                                    value="{{ $denoising_strength }}" name="denoising_strength" placeholder="Denoising strength">
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
                                        <h4 class="card-title">Globle Anime prompts</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Globle Anime Prompts</th>
                                                        <th>Globle Anime Terms</th>
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
                                                <td>{{ $globle_anime_prompts }}</td>
                                                <td>{{ $globle_anime_terms }}</td>
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



@include('admin.layout.footer')