<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;

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

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => ['required', 'regex:/^(010|011|012|015)\d{8}$/'],
            'address' => 'required|string',
            'postal_code' => 'nullable|digits:5',
            'governorate' => 'required|exists:governorates,id',
        ]);

        $carts = Cart::where('user_id', auth()->id())->get();

        // check quantity 
        foreach($carts as $cart) {
            if($cart->quantity > $cart->product->quantity) {
                return redirect()->back()->with('error', __('words.outOfStock'));
            }
        }
        
        // store total price in variable
        $total_price = $request->shipping;
        foreach($carts as $cart) {
            $total_price += $cart->product->price * $cart->quantity;
        }
    
        $order = Order::create([
            'user_id' => auth()->id(),
            'number' => now()->format('dmY') . random_int(10000000, 99999999),
            'total_price' => $total_price,
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
    
    
        return redirect()->back()->with('success', __('words.saveSucc'));
    }
    

    public function deliveryPrice($id) {

        $delivery_price = Governorate::where('id', $id)->pluck('delivery_price')->first();

        return response()->json(['success' => true, 'delivery_price' => $delivery_price]);

    }
}
