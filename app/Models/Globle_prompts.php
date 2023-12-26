<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Globle_prompts extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'globle_prompts';

    protected $fillable = [
        'id', 
        'prompt_Url',
        'globle_realistic_prompts',
        'globle_anime_prompts',
        'globle_realistic_terms',
        'globle_anime_terms',
        'globle_anime_nagative_prompt',
        'globle_realistic_nagative_prompt',
        'wordsphrases',
        'cfg_scale',
        'restore_faces',
        'seed',
        'denoising_strength',
        'enable_hr',
        'hr_scale',
        'hr_upscaler',
        'sampler_index',
        'email',
        'steps',
        'type',
        'args',
        'method',
        'endpoint',
        'sd_model_checkpoint',
        'sd_vae',
        'width',
        'height',
        'sampler_name',
        'override_settings_restore_afterwards',
        'ad_cfg_scale',
        'ad_checkpoint',
        'ad_clip_skip',
        'ad_confidence',
        'ad_controlnet_guidance_end',
        'ad_controlnet_guidance_start',
        'ad_controlnet_model',
        'ad_controlnet_module',
        'ad_controlnet_weight',
        'ad_denoising_strength',
        'ad_dilate_erode',
        'ad_inpaint_height',
        'ad_inpaint_only_masked',
        'ad_inpaint_only_masked_padding',
        'ad_inpaint_width',
        'ad_mask_blur',
        'ad_mask_k_largest',
        'ad_mask_max_ratio',
        'ad_mask_merge_invert',
        'ad_mask_min_ratio',
        'ad_model',
        'ad_negative_prompt',
        'ad_noise_multiplier',
        'ad_prompt',
        'ad_restore_face',
        'ad_sampler',
        'ad_steps',
        'ad_use_cfg_scale',
        'ad_use_checkpoint',
        'ad_use_clip_skip',
        'ad_use_inpaint_width_height',
        'ad_use_noise_multiplier',
        'ad_use_sampler',
        'ad_use_steps',
        'ad_use_vae',
        'ad_vae',
        'ad_x_offset',
        'ad_y_offset',
        'is_api',
    ];
}
