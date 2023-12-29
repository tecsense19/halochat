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




$method = isset($profilegloble->method) ? $profilegloble->method : '';
$endpoint = isset($profilegloble->endpoint) ? $profilegloble->endpoint : '';
$sd_model_checkpoint = isset($profilegloble->sd_model_checkpoint) ? $profilegloble->sd_model_checkpoint : '';
$sd_vae = isset($profilegloble->sd_vae) ? $profilegloble->sd_vae : '';
$width = isset($profilegloble->width) ? $profilegloble->width : '';
$height = isset($profilegloble->height) ? $profilegloble->height : '';
$sampler_name = isset($profilegloble->sampler_name) ? $profilegloble->sampler_name : '';
$override_settings_restore_afterwards = isset($profilegloble->override_settings_restore_afterwards) ? $profilegloble->override_settings_restore_afterwards : '';

$args = isset($profilegloble->args) ? $profilegloble->args : '';

$ad_cfg_scale = explode(',', $profilegloble->ad_cfg_scale);
$ad_cfg_scale0 = isset($ad_cfg_scale[0] ) ? $ad_cfg_scale[0] : '';
$ad_cfg_scale1 = isset($ad_cfg_scale[1] ) ? $ad_cfg_scale[1] : '';


$ad_checkpoint = explode(',', $profilegloble->ad_cfg_scale);
$ad_checkpoint0 = isset($ad_checkpoint[0] ) ? $ad_checkpoint[0] : '';
$ad_checkpoint1 = isset($ad_checkpoint[1] ) ? $ad_checkpoint[1] : '';

$ad_clip_skip = explode(',', $profilegloble->ad_clip_skip);
$ad_clip_skip0 = isset($ad_clip_skip[0] ) ? $ad_clip_skip[0] : '';
$ad_clip_skip1 = isset($ad_clip_skip[1] ) ? $ad_clip_skip[1] : '';

$ad_confidence = explode(',', $profilegloble->ad_confidence);
$ad_confidence0 = isset($ad_confidence[0] ) ? $ad_confidence[0] : '';
$ad_confidence1 = isset($ad_confidence[1] ) ? $ad_confidence[1] : '';


$ad_controlnet_guidance_end = explode(',', $profilegloble->ad_controlnet_guidance_end);
$ad_controlnet_guidance_end0 = isset($ad_controlnet_guidance_end[0] ) ? $ad_controlnet_guidance_end[0] : '';
$ad_controlnet_guidance_end1 = isset($ad_controlnet_guidance_end[1] ) ? $ad_controlnet_guidance_end[1] : '';

$ad_controlnet_guidance_start = explode(',', $profilegloble->ad_controlnet_guidance_start);
$ad_controlnet_guidance_start0 = isset($ad_controlnet_guidance_start[0] ) ? $ad_controlnet_guidance_start[0] : '';
$ad_controlnet_guidance_start1 = isset($ad_controlnet_guidance_start[1] ) ? $ad_controlnet_guidance_start[1] : '';

$ad_controlnet_model = explode(',', $profilegloble->ad_controlnet_model);
$ad_controlnet_model0 = isset($ad_controlnet_model[0] ) ? $ad_controlnet_model[0] : '';
$ad_controlnet_model1 = isset($ad_controlnet_model[1] ) ? $ad_controlnet_model[1] : '';

$ad_controlnet_module = explode(',', $profilegloble->ad_controlnet_module);
$ad_controlnet_module0 = isset($ad_controlnet_module[0] ) ? $ad_controlnet_module[0] : '';
$ad_controlnet_module1 = isset($ad_controlnet_module[1] ) ? $ad_controlnet_module[1] : '';

$ad_controlnet_weight = explode(',', $profilegloble->ad_controlnet_weight);
$ad_controlnet_weight0 = isset($ad_controlnet_weight[0] ) ? $ad_controlnet_weight[0] : '';
$ad_controlnet_weight1 = isset($ad_controlnet_weight[1] ) ? $ad_controlnet_weight[1] : '';

$ad_denoising_strength = explode(',', $profilegloble->ad_denoising_strength);
$ad_denoising_strength0 = isset($ad_denoising_strength[0] ) ? $ad_denoising_strength[0] : '';
$ad_denoising_strength1 = isset($ad_denoising_strength[1] ) ? $ad_denoising_strength[1] : '';

$ad_dilate_erode = explode(',', $profilegloble->ad_dilate_erode);
$ad_dilate_erode0 = isset($ad_dilate_erode[0] ) ? $ad_dilate_erode[0] : '';
$ad_dilate_erode1 = isset($ad_dilate_erode[1] ) ? $ad_dilate_erode[1] : '';

$ad_inpaint_height = explode(',', $profilegloble->ad_inpaint_height);
$ad_inpaint_height0 = isset($ad_inpaint_height[0] ) ? $ad_inpaint_height[0] : '';
$ad_inpaint_height1 = isset($ad_inpaint_height[1] ) ? $ad_inpaint_height[1] : '';

$ad_inpaint_only_masked = explode(',', $profilegloble->ad_inpaint_only_masked);
$ad_inpaint_only_masked0 = isset($ad_inpaint_only_masked[0] ) ? $ad_inpaint_only_masked[0] : '';
$ad_inpaint_only_masked1 = isset($ad_inpaint_only_masked[1] ) ? $ad_inpaint_only_masked[1] : '';


$ad_inpaint_only_masked_padding = explode(',', $profilegloble->ad_inpaint_only_masked_padding);
$ad_inpaint_only_masked_padding0 = isset($ad_inpaint_only_masked_padding[0] ) ? $ad_inpaint_only_masked_padding[0] : '';
$ad_inpaint_only_masked_padding1 = isset($ad_inpaint_only_masked_padding[1] ) ? $ad_inpaint_only_masked_padding[1] : '';

$ad_inpaint_width = explode(',', $profilegloble->ad_inpaint_width);
$ad_inpaint_width0 = isset($ad_inpaint_width[0] ) ? $ad_inpaint_width[0] : '';
$ad_inpaint_width1 = isset($ad_inpaint_width[1] ) ? $ad_inpaint_width[1] : '';

$ad_mask_blur = explode(',', $profilegloble->ad_mask_blur);
$ad_mask_blur0 = isset($ad_mask_blur[0] ) ? $ad_mask_blur[0] : '';
$ad_mask_blur1 = isset($ad_mask_blur[1] ) ? $ad_mask_blur[1] : '';

$ad_mask_k_largest = explode(',', $profilegloble->ad_mask_k_largest);
$ad_mask_k_largest0 = isset($ad_mask_k_largest[0] ) ? $ad_mask_k_largest[0] : '';
$ad_mask_k_largest1 = isset($ad_mask_k_largest[1] ) ? $ad_mask_k_largest[1] : '';

$ad_mask_max_ratio = explode(',', $profilegloble->ad_mask_max_ratio);
$ad_mask_max_ratio0 = isset($ad_mask_max_ratio[0] ) ? $ad_mask_max_ratio[0] : '';
$ad_mask_max_ratio1 = isset($ad_mask_max_ratio[1] ) ? $ad_mask_max_ratio[1] : '';

$ad_mask_merge_invert = explode(',', $profilegloble->ad_mask_merge_invert);
$ad_mask_merge_invert0 = isset($ad_mask_merge_invert[0] ) ? $ad_mask_merge_invert[0] : '';
$ad_mask_merge_invert1 = isset($ad_mask_merge_invert[1] ) ? $ad_mask_merge_invert[1] : '';

$ad_mask_min_ratio = explode(',', $profilegloble->ad_mask_min_ratio);
$ad_mask_min_ratio0 = isset($ad_mask_min_ratio[0] ) ? $ad_mask_min_ratio[0] : '';
$ad_mask_min_ratio1 = isset($ad_mask_min_ratio[1] ) ? $ad_mask_min_ratio[1] : '';

$ad_model = explode(',', $profilegloble->ad_model);
$ad_model0 = isset($ad_model[0] ) ? $ad_model[0] : '';
$ad_model1 = isset($ad_model[1] ) ? $ad_model[1] : '';

$ad_negative_prompt = explode(',', $profilegloble->ad_negative_prompt);
$ad_negative_prompt0 = isset($ad_negative_prompt[0] ) ? $ad_negative_prompt[0] : '';
$ad_negative_prompt1 = isset($ad_negative_prompt[1] ) ? $ad_negative_prompt[1] : '';

$ad_noise_multiplier = explode(',', $profilegloble->ad_noise_multiplier);
$ad_noise_multiplier0 = isset($ad_noise_multiplier[0] ) ? $ad_noise_multiplier[0] : '';
$ad_noise_multiplier1 = isset($ad_noise_multiplier[1] ) ? $ad_noise_multiplier[1] : '';

$ad_prompt = explode(',', $profilegloble->ad_prompt);
$ad_prompt0 = isset($ad_prompt[0] ) ? $ad_prompt[0] : '';
$ad_prompt1 = isset($ad_prompt[1] ) ? $ad_prompt[1] : '';

$ad_restore_face = explode(',', $profilegloble->ad_restore_face);
$ad_restore_face0 = isset($ad_restore_face[0] ) ? $ad_restore_face[0] : '';
$ad_restore_face1 = isset($ad_restore_face[1] ) ? $ad_restore_face[1] : '';

$ad_sampler = explode(',', $profilegloble->ad_sampler);
$ad_sampler0 = isset($ad_sampler[0] ) ? $ad_sampler[0] : '';
$ad_sampler1 = isset($ad_sampler[1] ) ? $ad_sampler[1] : '';

$ad_steps = explode(',', $profilegloble->ad_steps);
$ad_steps0 = isset($ad_steps[0] ) ? $ad_steps[0] : '';
$ad_steps1 = isset($ad_steps[1] ) ? $ad_steps[1] : '';

$ad_use_cfg_scale = explode(',', $profilegloble->ad_use_cfg_scale);
$ad_use_cfg_scale0 = isset($ad_use_cfg_scale[0] ) ? $ad_use_cfg_scale[0] : '';
$ad_use_cfg_scale1 = isset($ad_use_cfg_scale[1] ) ? $ad_use_cfg_scale[1] : '';

$ad_use_checkpoint = explode(',', $profilegloble->ad_use_checkpoint);
$ad_use_checkpoint0 = isset($ad_use_checkpoint[0] ) ? $ad_use_checkpoint[0] : '';
$ad_use_checkpoint1 = isset($ad_use_checkpoint[1] ) ? $ad_use_checkpoint[1] : '';

$ad_use_clip_skip = explode(',', $profilegloble->ad_use_clip_skip);
$ad_use_clip_skip0 = isset($ad_use_clip_skip[0] ) ? $ad_use_clip_skip[0] : '';
$ad_use_clip_skip1 = isset($ad_use_clip_skip[1] ) ? $ad_use_clip_skip[1] : '';

$ad_use_inpaint_width_height = explode(',', $profilegloble->ad_use_inpaint_width_height);
$ad_use_inpaint_width_height0 = isset($ad_use_inpaint_width_height[0] ) ? $ad_use_inpaint_width_height[0] : '';
$ad_use_inpaint_width_height1 = isset($ad_use_inpaint_width_height[1] ) ? $ad_use_inpaint_width_height[1] : '';

$ad_use_noise_multiplier = explode(',', $profilegloble->ad_use_noise_multiplier);
$ad_use_noise_multiplier0 = isset($ad_use_noise_multiplier[0] ) ? $ad_use_noise_multiplier[0] : '';
$ad_use_noise_multiplier1 = isset($ad_use_noise_multiplier[1] ) ? $ad_use_noise_multiplier[1] : '';

$ad_use_sampler = explode(',', $profilegloble->ad_use_sampler);
$ad_use_sampler0 = isset($ad_use_sampler[0] ) ? $ad_use_sampler[0] : '';
$ad_use_sampler1 = isset($ad_use_sampler[1] ) ? $ad_use_sampler[1] : '';

$ad_use_steps = explode(',', $profilegloble->ad_use_steps);
$ad_use_steps0 = isset($ad_use_steps[0] ) ? $ad_use_steps[0] : '';
$ad_use_steps1 = isset($ad_use_steps[1] ) ? $ad_use_steps[1] : '';

$ad_use_vae = explode(',', $profilegloble->ad_use_vae);
$ad_use_vae0 = isset($ad_use_vae[0] ) ? $ad_use_vae[0] : '';
$ad_use_vae1 = isset($ad_use_vae[1] ) ? $ad_use_vae[1] : '';

$ad_vae = explode(',', $profilegloble->ad_vae);
$ad_vae0 = isset($ad_vae[0] ) ? $ad_vae[0] : '';
$ad_vae1 = isset($ad_vae[1] ) ? $ad_vae[1] : '';

$ad_x_offset = explode(',', $profilegloble->ad_x_offset);
$ad_x_offset0 = isset($ad_x_offset[0] ) ? $ad_x_offset[0] : '';
$ad_x_offset1 = isset($ad_x_offset[1] ) ? $ad_x_offset[1] : '';

$ad_y_offset = explode(',', $profilegloble->ad_y_offset);
$ad_y_offset0 = isset($ad_y_offset[0] ) ? $ad_y_offset[0] : '';
$ad_y_offset1 = isset($ad_y_offset[1] ) ? $ad_y_offset[1] : '';

$is_api = explode(',', $profilegloble->is_api);
$is_api0 = isset($is_api[0] ) ? $is_api[0] : '';
$is_api1 = isset($is_api[1] ) ? $is_api[1] : '';


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
                            <!-- <div class="form-group">
                                <label for="Name">Globle Realistic Prompts</label>

                                <textarea class="form-control custom-min-height" name="globle_realistic_prompts" id="globle_realistic_prompts" cols="30" rows="10" placeholder="Globle Realistic Prompts">{{ $globle_realistic_prompts }}</textarea>
                                   
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
                            </div> -->

                            <div class="form-group">
                                <label for="Name">Words to remove from user image requests</label>
                                <textarea class="form-control custom-min-height" name="wordsphrases" id="wordsphrases" cols="30" rows="10" placeholder="Words and phrases">{{ $wordsphrases }}</textarea>
                                <input type="hidden" value="realistic" name="type"> 
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
                         

                            <!-- <div class="form-group">
                                <label for="Name">Restore faces</label>
                                <input type="text" class="form-control" id="restore_faces" id="restore_faces"
                                    value="{{ $restore_faces }}" name="restore_faces" placeholder="Restore faces">
                                    @error('restore_faces')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div> -->

                           

                            <div class="form-group">
                                <label for="Name">Method</label>
                                <input type="text" class="form-control" id="method" id="method"
                                    value="{{ $method }}" name="method" placeholder="method">
                                    @error('method')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">Endpoint</label>
                                <input type="text" class="form-control" id="endpoint" id="endpoint"
                                    value="{{ $endpoint }}" name="endpoint" placeholder="endpoint">
                                    @error('endpoint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">sd_model_checkpoint</label>
                                <input type="text" class="form-control" id="sd_model_checkpoint" id="sd_model_checkpoint"
                                    value="{{ $sd_model_checkpoint }}" name="sd_model_checkpoint" placeholder="sd_model_checkpoint">
                                    @error('sd_model_checkpoint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">sd_vae</label>
                                <input type="text" class="form-control" id="sd_vae" id="sd_vae"
                                    value="{{ $sd_vae }}" name="sd_vae" placeholder="sd_vae">
                                    @error('sd_vae')
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
                                <label for="Name">Width</label>
                                <input type="text" class="form-control" id="width" id="width"
                                    value="{{ $width }}" name="width" placeholder="width">
                                    @error('width')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">Height</label>
                                <input type="text" class="form-control" id="height" id="height"
                                    value="{{ $height }}" name="height" placeholder="height">
                                    @error('height')
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

                            <!-- <div class="form-group">
                                <label for="Name">sampler_index</label>
                                <input type="text" class="form-control" id="sampler_index" id="sampler_index"
                                    value="{{ $sampler_index }}" name="sampler_index" placeholder="sampler_index">
                                    @error('sampler_index')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div> -->

                            <div class="form-group">
                                <label for="Name">sampler_name</label>
                                <input type="text" class="form-control" id="sampler_name" id="sampler_name"
                                    value="{{ $sampler_name }}" name="sampler_name" placeholder="sampler_name">
                                    @error('sampler_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="col-md-6">
                          <div class="form-group row">
                          <label for="Name">override_settings_restore_afterwards</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" id="override_settings_restore_afterwards" name="override_settings_restore_afterwards" value="true" <?php if($override_settings_restore_afterwards == "true") { ?> checked <?php } else{ ?> <?php } ?>  > true </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" id="override_settings_restore_afterwards" name="override_settings_restore_afterwards" value="false" <?php if($override_settings_restore_afterwards == "false") { ?> checked <?php } else{ ?> <?php } ?>  > false </label>
                              </div>
                            </div>
                            </div>
                            </div>
                      

                            <!-- <div class="col-md-6">
                        <div class="form-group row">
                        <label for="Name">args</label>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="args[]" id="args1" value="true" <?php $true = explode(',', $args); if(isset($true[1]) && $true[1] == "true"){ ?>checked <?php } else if(isset($true[0]) && $true[0] == "true") { ?> checked <?php } else { ?> <?php } ?>> true <i class="input-helper"></i></label>
                            </div>
                            </div>
                            <div class="col-sm-5">
                                 <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="args[]" id="args" value="false" <?php $false = explode(',', $args); if(isset($false[1]) && $false[1] == "false"){ ?>checked <?php } else if(isset($false[0]) && $false[0] == "false") { ?> checked <?php } else { ?> <?php } ?>> false <i class="input-helper"></i></label>
                                  </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-md-12">
                     <div class="row">
                        <div class="col-sm-6" id="true-div">
                            <div class="form-group">
                                <label for="Name">ad_cfg_scale</label>
                                <input type="text" class="form-control" id="ad_cfg_scale"
                                    value="{{ $ad_cfg_scale0 }}" name="ad_cfg_scale[]" placeholder="ad_cfg_scale">
                                    @error('ad_cfg_scale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_checkpoint</label>
                                <input type="text" class="form-control" id="ad_checkpoint"
                                    value="{{ $ad_checkpoint0 }}" name="ad_checkpoint[]" placeholder="ad_checkpoint">
                                    @error('ad_checkpoint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_clip_skip</label>
                                <input type="text" class="form-control" id="ad_clip_skip"
                                    value="{{ $ad_clip_skip0 }}" name="ad_clip_skip[]" placeholder="ad_clip_skip">
                                    @error('ad_clip_skip')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_confidence</label>
                                <input type="text" class="form-control" id="ad_confidence"
                                    value="{{ $ad_confidence0 }}" name="ad_confidence[]" placeholder="ad_confidence">
                                    @error('ad_confidence')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="Name">ad_controlnet_guidance_end</label>
                                <input type="text" class="form-control" id="ad_controlnet_guidance_end"
                                    value="{{ $ad_controlnet_guidance_end0 }}" name="ad_controlnet_guidance_end[]" placeholder="ad_controlnet_guidance_end">
                                    @error('ad_controlnet_guidance_end')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_controlnet_guidance_start</label>
                                <input type="text" class="form-control" id="ad_controlnet_guidance_start"
                                    value="{{ $ad_controlnet_guidance_start0 }}" name="ad_controlnet_guidance_start[]" placeholder="ad_controlnet_guidance_start">
                                    @error('ad_controlnet_guidance_start')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_controlnet_model</label>
                                <input type="text" class="form-control" id="ad_controlnet_model" 
                                    value="{{ $ad_controlnet_model0 }}" name="ad_controlnet_model[]" placeholder="ad_controlnet_model">
                                    @error('ad_controlnet_model')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_controlnet_module</label>
                                <input type="text" class="form-control" id="ad_controlnet_module[]"
                                    value="{{ $ad_controlnet_module0 }}" name="ad_controlnet_module[]" placeholder="ad_controlnet_module">
                                    @error('ad_controlnet_module')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_controlnet_weight</label>
                                <input type="text" class="form-control" id="ad_controlnet_weight"
                                    value="{{ $ad_controlnet_weight0 }}" name="ad_controlnet_weight[]" placeholder="ad_controlnet_weight">
                                    @error('ad_controlnet_weight')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_denoising_strength</label>
                                <input type="text" class="form-control" id="ad_denoising_strength"
                                    value="{{ $ad_denoising_strength0 }}" name="ad_denoising_strength[]" placeholder="ad_denoising_strength">
                                    @error('ad_denoising_strength')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_dilate_erode</label>
                                <input type="text" class="form-control" id="ad_dilate_erode"
                                    value="{{ $ad_dilate_erode0 }}" name="ad_dilate_erode[]" placeholder="ad_dilate_erode">
                                    @error('ad_dilate_erode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_height</label>
                                <input type="text" class="form-control" id="ad_inpaint_height"
                                    value="{{ $ad_inpaint_height0 }}" name="ad_inpaint_height[]" placeholder="ad_inpaint_height">
                                    @error('ad_inpaint_height')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_only_masked</label>
                                <input type="text" class="form-control" id="ad_inpaint_only_masked"
                                    value="{{ $ad_inpaint_only_masked0 }}" name="ad_inpaint_only_masked[]" placeholder="ad_inpaint_only_masked">
                                    @error('ad_inpaint_only_masked')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_only_masked_padding</label>
                                <input type="text" class="form-control" id="ad_inpaint_only_masked_padding"
                                    value="{{ $ad_inpaint_only_masked_padding0 }}" name="ad_inpaint_only_masked_padding[]" placeholder="ad_inpaint_only_masked_padding">
                                    @error('ad_inpaint_only_masked_padding')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_width</label>
                                <input type="text" class="form-control" id="ad_inpaint_width"
                                    value="{{ $ad_inpaint_width0 }}" name="ad_inpaint_width[]" placeholder="ad_inpaint_width">
                                    @error('ad_inpaint_width')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_mask_blur</label>
                                <input type="text" class="form-control" id="ad_mask_blur"
                                    value="{{ $ad_mask_blur0 }}" name="ad_mask_blur[]" placeholder="ad_mask_blur">
                                    @error('ad_mask_blur')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_mask_k_largest</label>
                                <input type="text" class="form-control" id="ad_mask_k_largest"
                                    value="{{ $ad_mask_k_largest0 }}" name="ad_mask_k_largest[]" placeholder="ad_mask_k_largest">
                                    @error('ad_mask_k_largest')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_mask_max_ratio</label>
                                <input type="text" class="form-control" id="ad_mask_max_ratio"
                                    value="{{ $ad_mask_max_ratio0 }}" name="ad_mask_max_ratio[]" placeholder="ad_mask_max_ratio">
                                    @error('ad_mask_max_ratio')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_mask_merge_invert</label>
                                <input type="text" class="form-control" id="ad_mask_merge_invert" 
                                    value="{{ $ad_mask_merge_invert0 }}" name="ad_mask_merge_invert[]" placeholder="ad_mask_merge_invert">
                                    @error('ad_mask_merge_invert')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="Name">ad_mask_min_ratio</label>
                                <input type="text" class="form-control" id="ad_mask_min_ratio"
                                    value="{{ $ad_mask_min_ratio0 }}" name="ad_mask_min_ratio[]" placeholder="ad_mask_min_ratio">
                                    @error('ad_mask_min_ratio')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_model</label>
                                <input type="text" class="form-control" id="ad_model"
                                    value="{{ $ad_model0 }}" name="ad_model[]" placeholder="ad_model">
                                    @error('ad_model')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_negative_prompt</label>
                                <input type="text" class="form-control" id="ad_negative_prompt"
                                    value="{{ $ad_negative_prompt0 }}" name="ad_negative_prompt[]" placeholder="ad_negative_prompt">
                                    @error('ad_negative_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_noise_multiplier</label>
                                <input type="text" class="form-control" id="ad_noise_multiplier" 
                                    value="{{ $ad_noise_multiplier0 }}" name="ad_noise_multiplier[]" placeholder="ad_noise_multiplier">
                                    @error('ad_noise_multiplier')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_prompt</label>
                                <input type="text" class="form-control" id="ad_prompt" 
                                    value="{{ $ad_prompt0 }}" name="ad_prompt[]" placeholder="ad_prompt">
                                    @error('ad_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_restore_face</label>
                                <input type="text" class="form-control" id="ad_restore_face" 
                                    value="{{ $ad_restore_face0 }}" name="ad_restore_face[]" placeholder="ad_restore_face">
                                    @error('ad_restore_face')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_sampler</label>
                                <input type="text" class="form-control" id="ad_sampler"
                                    value="{{ $ad_sampler0 }}" name="ad_sampler[]" placeholder="ad_sampler">
                                    @error('ad_sampler')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_steps</label>
                                <input type="text" class="form-control" id="ad_steps"
                                    value="{{ $ad_steps0 }}" name="ad_steps[]" placeholder="ad_steps">
                                    @error('ad_steps')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_cfg_scale</label>
                                <input type="text" class="form-control" id="ad_use_cfg_scale"
                                    value="{{ $ad_use_cfg_scale0 }}" name="ad_use_cfg_scale[]" placeholder="ad_use_cfg_scale">
                                    @error('ad_use_cfg_scale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="Name">ad_use_checkpoint</label>
                                <input type="text" class="form-control" id="ad_use_checkpoint"
                                    value="{{ $ad_use_checkpoint0 }}" name="ad_use_checkpoint[]" placeholder="ad_use_checkpoint">
                                    @error('ad_use_checkpoint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_clip_skip</label>
                                <input type="text" class="form-control" id="ad_use_clip_skip"
                                    value="{{ $ad_use_clip_skip0 }}" name="ad_use_clip_skip[]" placeholder="ad_use_clip_skip">
                                    @error('ad_use_clip_skip')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_inpaint_width_height</label>
                                <input type="text" class="form-control" id="ad_use_inpaint_width_height"
                                    value="{{ $ad_use_inpaint_width_height0 }}" name="ad_use_inpaint_width_height[]" placeholder="ad_use_inpaint_width_height">
                                    @error('ad_use_inpaint_width_height')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_noise_multiplier</label>
                                <input type="text" class="form-control" id="ad_use_noise_multiplier"
                                    value="{{ $ad_use_noise_multiplier0 }}" name="ad_use_noise_multiplier[]" placeholder="ad_use_noise_multiplier">
                                    @error('ad_use_noise_multiplier')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_sampler</label>
                                <input type="text" class="form-control" id="ad_use_sampler"
                                    value="{{ $ad_use_sampler0 }}" name="ad_use_sampler[]" placeholder="ad_use_sampler">
                                    @error('ad_use_sampler')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_steps</label>
                                <input type="text" class="form-control" id="ad_use_steps"
                                    value="{{ $ad_use_steps0 }}" name="ad_use_steps[]" placeholder="ad_use_steps">
                                    @error('ad_use_steps')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_vae</label>
                                <input type="text" class="form-control" id="ad_use_vae"
                                    value="{{ $ad_use_vae0 }}" name="ad_use_vae[]" placeholder="ad_use_vae">
                                    @error('ad_use_vae')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_vae</label>
                                <input type="text" class="form-control" id="ad_vae"
                                    value="{{ $ad_vae0 }}" name="ad_vae[]" placeholder="ad_vae">
                                    @error('ad_vae')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_x_offset</label>
                                <input type="text" class="form-control" id="ad_x_offset"
                                    value="{{ $ad_x_offset0 }}" name="ad_x_offset[]" placeholder="ad_x_offset">
                                    @error('ad_x_offset')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>


                            <div class="form-group">
                                <label for="Name">ad_y_offset</label>
                                <input type="text" class="form-control" id="ad_y_offset"
                                    value="{{ $ad_y_offset0 }}" name="ad_y_offset[]" placeholder="ad_y_offset">
                                    @error('ad_y_offset')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">is_api</label>
                                <input type="text" class="form-control" id="is_api"
                                    value="{{ $is_api0 }}" name="is_api[]" placeholder="is_api">
                                    @error('is_api')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            </div>
                            <div class="col-sm-6" id="false-div">
                            <div class="form-group">
                                <label for="Name">ad_cfg_scale</label>
                                <input type="text" class="form-control" id="ad_cfg_scale"
                                    value="{{ $ad_cfg_scale1 }}" name="ad_cfg_scale[]" placeholder="ad_cfg_scale">
                                    @error('ad_cfg_scale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_checkpoint</label>
                                <input type="text" class="form-control" id="ad_checkpoint"
                                    value="{{ $ad_checkpoint1 }}" name="ad_checkpoint[]" placeholder="ad_checkpoint">
                                    @error('ad_checkpoint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_clip_skip</label>
                                <input type="text" class="form-control" id="ad_clip_skip"
                                    value="{{ $ad_clip_skip1 }}" name="ad_clip_skip[]" placeholder="ad_clip_skip">
                                    @error('ad_clip_skip')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_confidence</label>
                                <input type="text" class="form-control" id="ad_confidence"
                                    value="{{ $ad_confidence1 }}" name="ad_confidence[]" placeholder="ad_confidence">
                                    @error('ad_confidence')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="Name">ad_controlnet_guidance_end</label>
                                <input type="text" class="form-control" id="ad_controlnet_guidance_end"
                                    value="{{ $ad_controlnet_guidance_end1 }}" name="ad_controlnet_guidance_end[]" placeholder="ad_controlnet_guidance_end">
                                    @error('ad_controlnet_guidance_end')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_controlnet_guidance_start</label>
                                <input type="text" class="form-control" id="ad_controlnet_guidance_start"
                                    value="{{ $ad_controlnet_guidance_start1 }}" name="ad_controlnet_guidance_start[]" placeholder="ad_controlnet_guidance_start">
                                    @error('ad_controlnet_guidance_start')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_controlnet_model</label>
                                <input type="text" class="form-control" id="ad_controlnet_model"
                                    value="{{ $ad_controlnet_model1 }}" name="ad_controlnet_model[]" placeholder="ad_controlnet_model">
                                    @error('ad_controlnet_model')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_controlnet_module</label>
                                <input type="text" class="form-control" id="ad_controlnet_module"
                                    value="{{ $ad_controlnet_module1 }}" name="ad_controlnet_module[]" placeholder="ad_controlnet_module">
                                    @error('ad_controlnet_module')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_controlnet_weight</label>
                                <input type="text" class="form-control" id="ad_controlnet_weight"
                                    value="{{ $ad_controlnet_weight1 }}" name="ad_controlnet_weight[]" placeholder="ad_controlnet_weight">
                                    @error('ad_controlnet_weight')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_denoising_strength</label>
                                <input type="text" class="form-control" id="ad_denoising_strength"
                                    value="{{ $ad_denoising_strength1 }}" name="ad_denoising_strength[]" placeholder="ad_denoising_strength">
                                    @error('ad_denoising_strength')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_dilate_erode</label>
                                <input type="text" class="form-control" id="ad_dilate_erode" 
                                    value="{{ $ad_dilate_erode1 }}" name="ad_dilate_erode[]" placeholder="ad_dilate_erode">
                                    @error('ad_dilate_erode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_height</label>
                                <input type="text" class="form-control" id="ad_inpaint_height"
                                    value="{{ $ad_inpaint_height1 }}" name="ad_inpaint_height[]" placeholder="ad_inpaint_height">
                                    @error('ad_inpaint_height')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_only_masked</label>
                                <input type="text" class="form-control" id="ad_inpaint_only_masked"
                                    value="{{ $ad_inpaint_only_masked1 }}" name="ad_inpaint_only_masked[]" placeholder="ad_inpaint_only_masked">
                                    @error('ad_inpaint_only_masked')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_only_masked_padding</label>
                                <input type="text" class="form-control" id="ad_inpaint_only_masked_padding"
                                    value="{{ $ad_inpaint_only_masked_padding1 }}" name="ad_inpaint_only_masked_padding[]" placeholder="ad_inpaint_only_masked_padding">
                                    @error('ad_inpaint_only_masked_padding')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_inpaint_width</label>
                                <input type="text" class="form-control" id="ad_inpaint_width" id="ad_inpaint_width"
                                    value="{{ $ad_inpaint_width1 }}" name="ad_inpaint_width[]" placeholder="ad_inpaint_width">
                                    @error('ad_inpaint_width')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_mask_blur</label>
                                <input type="text" class="form-control" id="ad_mask_blur" 
                                    value="{{ $ad_mask_blur1 }}" name="ad_mask_blur[]" placeholder="ad_mask_blur">
                                    @error('ad_mask_blur')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_mask_k_largest</label>
                                <input type="text" class="form-control" id="ad_mask_k_largest"
                                    value="{{ $ad_mask_k_largest1 }}" name="ad_mask_k_largest[]" placeholder="ad_mask_k_largest">
                                    @error('ad_mask_k_largest')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_mask_max_ratio</label>
                                <input type="text" class="form-control" id="ad_mask_max_ratio" 
                                    value="{{ $ad_mask_max_ratio1 }}" name="ad_mask_max_ratio[]" placeholder="ad_mask_max_ratio">
                                    @error('ad_mask_max_ratio')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_mask_merge_invert</label>
                                <input type="text" class="form-control" id="ad_mask_merge_invert"
                                    value="{{ $ad_mask_merge_invert1 }}" name="ad_mask_merge_invert[]" placeholder="ad_mask_merge_invert">
                                    @error('ad_mask_merge_invert')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="Name">ad_mask_min_ratio</label>
                                <input type="text" class="form-control" id="ad_mask_min_ratio"
                                    value="{{ $ad_mask_min_ratio1 }}" name="ad_mask_min_ratio[]" placeholder="ad_mask_min_ratio">
                                    @error('ad_mask_min_ratio')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_model</label>
                                <input type="text" class="form-control" id="ad_model"
                                    value="{{ $ad_model1 }}" name="ad_model[]" placeholder="ad_model">
                                    @error('ad_model')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_negative_prompt</label>
                                <input type="text" class="form-control" id="ad_negative_prompt" 
                                    value="{{ $ad_negative_prompt1 }}" name="ad_negative_prompt[]" placeholder="ad_negative_prompt">
                                    @error('ad_negative_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_noise_multiplier</label>
                                <input type="text" class="form-control" id="ad_noise_multiplier"
                                    value="{{ $ad_noise_multiplier1 }}" name="ad_noise_multiplier[]" placeholder="ad_noise_multiplier">
                                    @error('ad_noise_multiplier')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_prompt</label>
                                <input type="text" class="form-control" id="ad_prompt" 
                                    value="{{ $ad_prompt1 }}" name="ad_prompt[]" placeholder="ad_prompt">
                                    @error('ad_prompt')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_restore_face</label>
                                <input type="text" class="form-control" id="ad_restore_face"
                                    value="{{ $ad_restore_face1 }}" name="ad_restore_face[]" placeholder="ad_restore_face">
                                    @error('ad_restore_face')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_sampler</label>
                                <input type="text" class="form-control" id="ad_sampler" 
                                    value="{{ $ad_sampler1 }}" name="ad_sampler[]" placeholder="ad_sampler">
                                    @error('ad_sampler')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="Name">ad_steps</label>
                                <input type="text" class="form-control" id="ad_steps"
                                    value="{{ $ad_steps1 }}" name="ad_steps[]" placeholder="ad_steps">
                                    @error('ad_steps')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_cfg_scale</label>
                                <input type="text" class="form-control" id="ad_use_cfg_scale"
                                    value="{{ $ad_use_cfg_scale1 }}" name="ad_use_cfg_scale[]" placeholder="ad_use_cfg_scale">
                                    @error('ad_use_cfg_scale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="Name">ad_use_checkpoint</label>
                                <input type="text" class="form-control" id="ad_use_checkpoint"
                                    value="{{ $ad_use_checkpoint1 }}" name="ad_use_checkpoint[]" placeholder="ad_use_checkpoint">
                                    @error('ad_use_checkpoint')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_clip_skip</label>
                                <input type="text" class="form-control" id="ad_use_clip_skip"
                                    value="{{ $ad_use_clip_skip1 }}" name="ad_use_clip_skip[]" placeholder="ad_use_clip_skip">
                                    @error('ad_use_clip_skip')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_inpaint_width_height</label>
                                <input type="text" class="form-control" id="ad_use_inpaint_width_height"
                                    value="{{ $ad_use_inpaint_width_height1 }}" name="ad_use_inpaint_width_height[]" placeholder="ad_use_inpaint_width_height">
                                    @error('ad_use_inpaint_width_height')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_noise_multiplier</label>
                                <input type="text" class="form-control" id="ad_use_noise_multiplier"
                                    value="{{ $ad_use_noise_multiplier1 }}" name="ad_use_noise_multiplier[]" placeholder="ad_use_noise_multiplier">
                                    @error('ad_use_noise_multiplier')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_sampler</label>
                                <input type="text" class="form-control" id="ad_use_sampler"
                                    value="{{ $ad_use_sampler1 }}" name="ad_use_sampler[]" placeholder="ad_use_sampler">
                                    @error('ad_use_sampler')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_steps</label>
                                <input type="text" class="form-control" id="ad_use_steps"
                                    value="{{ $ad_use_steps1 }}" name="ad_use_steps[]" placeholder="ad_use_steps">
                                    @error('ad_use_steps')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_use_vae</label>
                                <input type="text" class="form-control" id="ad_use_vae"
                                    value="{{ $ad_use_vae1 }}" name="ad_use_vae[]" placeholder="ad_use_vae">
                                    @error('ad_use_vae')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_vae</label>
                                <input type="text" class="form-control" id="ad_vae" 
                                    value="{{ $ad_vae1 }}" name="ad_vae[]" placeholder="ad_vae">
                                    @error('ad_vae')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">ad_x_offset</label>
                                <input type="text" class="form-control" id="ad_x_offset"
                                    value="{{ $ad_x_offset1 }}" name="ad_x_offset[]" placeholder="ad_x_offset">
                                    @error('ad_x_offset')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>


                            <div class="form-group">
                                <label for="Name">ad_y_offset</label>
                                <input type="text" class="form-control" id="ad_y_offset"
                                    value="{{ $ad_y_offset1 }}" name="ad_y_offset[]" placeholder="ad_y_offset">
                                    @error('ad_y_offset')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="Name">is_api</label>
                                <input type="text" class="form-control" id="is_api"
                                    value="{{ $is_api1 }}" name="is_api[]" placeholder="is_api">
                                    @error('is_api')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            
                            </div>
                            </div> -->
                            
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
<script>
        // Function to handle checkbox state
        function handleCheckboxState(checkbox, divToHide) {
            if (checkbox.checked) {
                divToHide.style.display = 'block'; // hide the div
            } else {
                divToHide.style.display = 'none'; // show the div
            }
        }

        // Get references to the checkboxes and divs
        var checkbox = document.getElementById('args1');
        var divToHide = document.getElementById('true-div');
        

        var checkbox1 = document.getElementById('args');
        var divToHide1 = document.getElementById('false-div');

        // Add event listeners to the checkboxes
        checkbox.addEventListener('change', function () {
            handleCheckboxState(checkbox, divToHide);
        });

        checkbox1.addEventListener('change', function () {
            handleCheckboxState(checkbox1, divToHide1);
        });

        document.addEventListener('DOMContentLoaded', function () {
            handleCheckboxState(checkbox, divToHide);
            handleCheckboxState(checkbox1, divToHide1);
        });
    </script>


@include('admin.layout.footer')