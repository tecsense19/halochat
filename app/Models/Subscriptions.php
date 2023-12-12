<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subscriptions extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'subscriptions';

    protected $fillable = [
        'id', 
        'user_id', 
        'order_id', 
        'plan_id', 
        'product_id',
        'subscription_id',
        'customerId', 
        'authId',
        'transactionID', 
        'orderTotal', 
        'quantity',
        'subscription_level',
        'trial_start_date',
        'trial_end_date', 
        'subscription_start_date',
        'subscription_end_date',
        'subscription_next_date',
    ];
}
