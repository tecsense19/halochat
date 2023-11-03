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
        'name',
        'description',
        'age',
        'gender',
        'ethnicity',
        'personality',
        'occupation',
        'hobbies',
        'relationship_status',
        'body_description',
        'system_prompt',
        'system_instruction',
        'created_at',
        'updated_at',
    ];

    public function profileImages()
    {
        return $this->hasMany(ProfileImage::class, 'profile_id', 'profile_id');
    }

}
