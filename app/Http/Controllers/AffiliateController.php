<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Services\AffiliateService;

class AffiliateController extends Controller
{
    public function showRegistrationForm()
    {
        return view('affiliate.registration-affiliate');
    }

    public function register(Request $request, AffiliateService $affiliateService)
{
    
     

    $userId = auth()->id();

    $merchant = Merchant::where('user_id', $userId)->first();  

    if (!$merchant) {
     
        return redirect()->route('error')->with('error_message', 'Merchant not found');
    }

     
    $affiliate = $affiliateService->register(
        $merchant, // Pass the Merchant model
        $request->email,
        $request->name,
        $request->commission_rate,
        $request->discount_code
    );

    return back()->with('success_message', 'Affiliate registered successfully!');

}


}
