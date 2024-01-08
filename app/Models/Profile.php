<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'profiles';

    protected $fillable = [
        'profile_id',
        'sequence_profile',
        'name',
        'last_name',
        'description',
        'subscription_type',
        'age',
        'stability',
        'similarity_boost',
        'style',
        'gender',
        'ethnicity',
        'personality',
        'occupation',
        'hobbies',
        'voice_id',
        'voice_name',
        'voice_model',
        'max_prompt_length',
        'max_ai_reply_length',
        'short_description',
        'voice_preview_url',
        'relationship_status',
        'body_description',
        'system_prompt',
        'system_instruction',
        'prompt',
        'negative_prompt',
        'image_prompt',
        'lora_input',
        'created_at',
        'updated_at',
    ];

    public function profileImages()
    {
        return $this->hasMany(ProfileImage::class, 'profile_id', 'profile_id');
    }

}
