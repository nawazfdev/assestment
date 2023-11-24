<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Services\MerchantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

 
 

class MerchantController extends Controller
{
    public function __construct(
        MerchantService $merchantService
    ) {}

    /**
     * Useful order statistics for the merchant API.
    
     * @param Request $request Will include a from and to date
     * @return JsonResponse Should be in the form {count: total number of orders in range, commission_owed: amount of unpaid commissions for orders with an affiliate, revenue: sum order subtotals}
     */
   
    public function store(Request $request){
     $user_register   =new  MerchantService();
      $this->user_register=$user_register;
      $data = $request->all();
      $this->user_register->register($data);
    }
    public function getOrderStatistics(Request $request) 
    {
        $orders = Order::whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();
    
        $totalOrders = $orders->count();
        $unpaidCommissions = $orders->sum('commission_owed');
        $totalRevenue = $orders->sum('subtotal');
    
        return [
            'totalOrders' => $totalOrders,
            'unpaidCommissions' => $unpaidCommissions,
            'totalRevenue' => $totalRevenue,
        ];
        return response()->json(['totalOrders'=>$totalOrders,'unpaidCommissions'=>$unpaidCommissions,'totalRevenue'=>$totalRevenue,]);

    }
public function merchantcreate(){

    return view('merchant.merchant');
}
public function merchantstore(Request $request)
{
    $newMerchant=new MerchantService();
    $this->newMerchant=$newMerchant;
    $this->newMerchant->createmerchent($request);
}
public function findMerchantByEmailForm()
    {
        return view('merchant.find-merchant');
    }
public function findMerchantByEmail(Request $request){

    $Merchantemail=new MerchantService();
    $this->Merchantemail=$Merchantemail;
    $this->Merchantemail->findMerchantByEmail($request->email);


}
public function updateMerchant(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'domain' => 'string',
            'displayname' => 'string',
            'turn_customers' => 'boolean',
            'commission_rate' => 'numeric',
        ]);

        $response = $this->merchantService->updateMerchant($user, $validatedData);
        
        return $response;
    }
}