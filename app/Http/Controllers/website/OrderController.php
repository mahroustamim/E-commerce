<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function index() {

        $locale = app()->getLocale();

        $governorates = Governorate::select('id', "governorate_{$locale} as name", 'delivery_price')->get();

        $carts = Cart::where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect()->back();
        } 

        return view('website.checkout', compact('governorates', 'carts'));

    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'phone' => ['required', 'regex:/^(010|011|012|015)\d{8}$/'],
        'address' => 'required|string',
        'postal_code' => 'nullable|digits:5',
        'governorate' => 'required|exists:governorates,id',
        'stripeToken' => 'required', // Validate that stripe token is present
    ]);

    // Calculate total price
    $carts = Cart::where('user_id', auth()->id())->get();
    $total_price = $request->shipping;
    foreach($carts as $cart) {
        $total_price += $cart->product->price * $cart->quantity;
    }

    // Stripe payment process
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    try {
        $charge = Charge::create([
            'amount' => $total_price * 100, 
            'currency' => 'egp',
            'description' => 'Order payment',
            'source' => $request->stripeToken,
            'receipt_email' => $request->email,
        ]);
    } catch (CardException $e) {
        return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
    }

    // Save order and order items
    $order = Order::create([
        'user_id' => auth()->id(),
        'number' => now()->format('dmY') . random_int(10000000, 99999999),
        'total_price' => $total_price,
        'payment_status' => 'paid',
    ]);

    foreach($carts as $cart) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cart->product_id,
            'product_name' => $cart->product->{'name_'.app()->getLocale()},
            'price' => $cart->product->price,
            'quantity' => $cart->quantity,
            'color' => $cart->color,
            'size' => $cart->size,
        ]);

        // Decrease product stock
        $cart->product->quantity -= $cart->quantity;
        $cart->product->save();
    }

    OrderAddress::create([
        'order_id' => $order->id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'postal_code' => $request->postal_code,
        'governorate_id' => $request->governorate,
    ]);

    Cart::where('user_id', auth()->id())->delete();

    return redirect()->route('website.home')->with('success', __('words.saveSucc'));
}
    

    public function deliveryPrice($id) {

        $delivery_price = Governorate::where('id', $id)->pluck('delivery_price')->first();

        return response()->json(['success' => true, 'delivery_price' => $delivery_price]);

    }
}
