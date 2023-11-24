<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
{
    $orderData = $request->validate([
        'subtotal_price' => 'required|numeric',
        'merchant_domain' => 'required|string',
        'discount_code' => 'nullable|string',
        'customer_email' => 'required|email',
        'customer_name' => 'required|string',
    ]);

    $this->orderService->processOrder($orderData);

    return response()->json(['message' => 'Order processed successfully'], 201);
}
}
