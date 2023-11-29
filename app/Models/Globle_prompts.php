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
      
    ];
}
