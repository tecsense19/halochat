<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Webhook_data extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'webhook_data';

    protected $fillable = [
            'id',
            'affid',
            'affiliate',
            'afid',
            'aid',
            'ancestor_id',
            'authorization_id',
            'billing_address_2',
            'billing_address',
            'billing_city',
            'billing_country',
            'billing_state_desc',
            'billing_state_id',
            'billing_zip',
            'c1',
            'c2',
            'c3',
            'campaign_desc',
            'campaign_id',
            'campaign_name',
            'cb_service_outcome',
            'cb_service_source',
            'cb_service_type',
            'cc_first_6',
            'cc_last_4',
            'click_id',
            'currency_code',
            'current_prepaid_cycle',
            'customer_id',
            'decline_reason',
            'decline_salvage_discount',
            'digital_delivery_password',
            'digital_delivery_username',
            'email',
            'first_name',
            'gateway_id',
            'ip_address',
            'ischargeback',
            'is_fraud',
            'is_gift',
            'is_recurring',
            'is_shippable',
            'is_test_cc',
            'last_name',
            'new_recurring_date',
            'non_taxable_amount',
            'opt',
            'order_date_time',
            'order_date',
            'order_id',
            'order_status',
            'order_total',
            'parent_order_id',
            'payment_method',
            'phone',
            'post_back_action',
            'prepaid_cycles',
            'product_id_csv',
            'product_names_csv',
            'product_prices_csv',
            'product_qtys_csv',
            'product_skus_csv',
            'rebill_depth',
            'rebill_discount',
            'recurring_date',
            'retry_attempt',
            'sales_tax_percent',
            'shipping_address_2',
            'shipping_address',
            'shipping_city',
            'shipping_country',
            'shipping_group_name',
            'shipping_id',
            'shipping_method',
            'shipping_state_desc',
            'shipping_state_id',
            'shipping_total',
            'shipping_zip',
            'sid',
            'subscription_active_csv',
            'subscription_id_csv',
            'sub_affiliate',
            'taxable_amount',
            'tax_factor',
            'total_no_shipping',
            'trackingnumber',
            'transaction_id',
            'utm_campaign',
            'utm_content',
            'utm_device_category',
            'utm_medium',
            'utm_source',
            'utm_term',
            'void_refund_amount',
            'was_reprocessed',
    ];
    

}
