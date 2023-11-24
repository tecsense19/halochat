<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usedcredites extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'usedcredites';

    protected $fillable = [
        'report_id', 
        'user_id',
        'credit',
        'debit',
        'credit_debit_date',
        'payment_id',
        'created_at',
        'updated_at',
    ];
    public function creditdebit()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
