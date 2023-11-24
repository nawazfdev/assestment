<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;

class OrderService
{
    public function __construct(
        protected AffiliateService $affiliateService
    ) {}

    /**
     * Process an order and log any commissions.
     * This should create a new affiliate if the customer_email is not already associated with one.
     * This method should also ignore duplicates based on order_id.
     *
     * @param  array{order_id: string, subtotal_price: float, merchant_domain: string, discount_code: string, customer_email: string, customer_name: string} $data
     * @return void
     */
    public function processOrder(array $data)
{
   
    $affiliate = Affiliate::where('email', $data['customer_email'])->first();
    $userId = auth()->id();
    if (!$affiliate) {
        $affiliate = Affiliate::create([
            'email' =>  $data['customer_email'],
            'merchant_id' => $merchant->id,
            'user_id' => $userId,
        'commission_rate' => $data['commission_rate'],
        'name' => $data['customer_name'],
        'discount_code' => $data['discount_code'],
        ]);

        $affiliate = Affiliate::create([
            'commission_rate' => $commissionRateCents,
            'email' => $email,
            'name' => $name,
            'discount_code' => '',  
        ]);
 
    }
    $duplicateOrderIds = Order::select('order_id')
    ->groupBy('order_id')
    ->havingRaw('count(*) > 1')
    ->pluck('order_id');

Order::whereIn('order_id', $duplicateOrderIds)->delete();
    }
    // Create the order record
    $order = Order::create([
        'merchant_id' => $this->getMerchantId($validatedData['merchant_domain']),
        'affiliate_id' => $affiliate->id,
        'subtotal' => $data['subtotal_price'],
        'commission_owed' => $commissionOwed,
        'payout_status' => Order::STATUS_UNPAID,
        'discount_code' => $data['discount_code'] ?? null,
        'customer_email' => $data['customer_email'],
        'customer_name' => $data['customer_name'],
    ]);
    $commissionRate = $affiliate->commission_rate; // Retrieve the affiliate's commission rate
    $commissionOwed = $validatedData['subtotal_price'] * ($commissionRate / 100); // Calculate commission based on subtotal and commission rate
    // Log the commission
    CommissionLog::create([
        'affiliate_id' => $affiliate->id,
        'amount' => $commissionOwed,
    ]);
}


