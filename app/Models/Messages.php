<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Messages extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'messages';

    protected $fillable = [
        'profile_id', 
        'user_id',
        'sender_id',
        'receiver_id',
        'status',
        'message_text',
        'timestamp',
        'media_url',
    ];

    public function reciverProfile()
    {
        return $this->hasMany(Profile::class, 'profile_id', 'receiver_id');
    }


}
