<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\ApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PayoutOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Order $order
    ) {}

    /**
     * Use the API service to send a payout of the correct amount.
     * Note: The order status must be paid if the payout is successful, or remain unpaid in the event of an exception.
     *
     * @return void
     */
    public function handle(ApiService $apiService)
    {
      if ($this->order->payout_status !== Order::STATUS_UNPAID) {
        return;
      }
    
      $affiliate = $this->order->affiliate;
    
      $payoutData = [
        'affiliate_id' => $affiliate->id,
        'amount' => $this->order->commission_owed,
      ];
    
      try {
        $apiService->sendPayout($payoutData);
    
        $this->order->update(['payout_status' => Order::STATUS_PAID]);
    
        PayoutLog::create([
          'affiliate_id' => $affiliate->id,
          'order_id' => $this->order->id,
          'amount' => $this->order->commission_owed,
        ]);
      } catch (Exception $e) {
        Log::error('Payout failed for order ' . $this->order->id . ': ' . $e->getMessage());
      }
    }
    
}
