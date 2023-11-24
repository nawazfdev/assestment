<?php

namespace App\Services;

use App\Jobs\PayoutOrderJob;
use App\Models\Affiliate;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MerchantService
{
    /**
     * Register a new user and associated merchant.
     * Hint: Use the password field to store the API key.
     * Hint: Be sure to set the correct user type according to the constants in the User model.
     *
     * @param array{domain: string, name: string, email: string, api_key: string} $data
     * @return Merchant
     */
public function register(array $data): Merchant
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['api_key']),
        'type' => User::TYPE_MERCHANT,
    ]);
    
return response->json(['msg'=>"User create successfully"]);
}

public function createmerchent($data){
    
     
    $user = User::where('type', 'merchant')->first();
if($user){
          $merchant = Merchant::create([
    'user_id' => $user->id,
    'domain' => $data['domain'],
    'display_name' => $data['displayname'],
    'turn_customers_into_affiliates' => $data['turn_customers'] ?? true,
    'default_commission_rate' => $data['commission_rate'] ?? 0.1,
]);
} 
     if ($merchant) {
            return response()->json(['message' => 'Merchant created successfully', 'data' => $merchant]);
        } else {
            return response()->json(['message' => 'Failed to create merchant'], 500);
        }
}
    /**
     * Update the user
     *
     * @param array{domain: string, name: string, email: string, api_key: string} $data
     * @return void
     */
    public function updateMerchant(User $user, array $data)
    {
        $merchant = Merchant::where('user_id', $user->id)->first();

        if ($merchant) {
            $updated = $merchant->update([
                'domain' => $data['domain'] ?? $merchant->domain,
                'display_name' => $data['displayname'] ?? $merchant->display_name,
                'turn_customers_into_affiliates' => $data['turn_customers'] ?? $merchant->turn_customers_into_affiliates,
                'default_commission_rate' => $data['commission_rate'] ?? $merchant->default_commission_rate,
            ]);

            if ($updated) {
                return response()->json(['message' => 'Merchant updated successfully', 'data' => $merchant]);
            } else {
                return response()->json(['message' => 'Failed to update merchant'], 500);
            }
        } else {
            return response()->json(['message' => 'Merchant not found'], 404);
        }
    }

    /**
     * Find a merchant by their email.
     * Hint: You'll need to look up the user first.
     *
     * @param string $email
     * @return Merchant|null
     */
    public function findMerchantByEmail(string $email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $merchant = $user->merchant;

            if ($merchant) {
                return response()->json(['message' => 'Merchant found', 'data' => $merchant]);
            }
        }

        return response()->json(['message' => 'No merchant found for the given email'], 404);
    }

    /**
     * Pay out all of an affiliate's orders.
     * Hint: You'll need to dispatch the job for each unpaid order.
     *
     * @param Affiliate $affiliate
     * @return void
     */
    public function payout(Affiliate $affiliate)
    {
        // Get all unpaid orders for the affiliate
        $unpaidOrders = $affiliate->orders()->where('payout_status', Order::STATUS_UNPAID)->get();

        // Dispatch a job for each unpaid order
        foreach ($unpaidOrders as $order) {
            dispatch(new PayoutOrderJob($order)); // Assuming PayoutOrderJob handles the payout logic for an order
        }
    } 
     
}
