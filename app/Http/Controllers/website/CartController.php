<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index($id) {

        $locale = app()->getLocale();
        $product = Product::where('id', $id)
            ->with('image')
            ->select('id', "name_{$locale} as name", 'category_id', "desc_{$locale} as desc", "brand_{$locale} as brand", 'price', 'discount', 'quantity', 'status', 'colors', 'sizes')
            ->first();


        // Check if product exists before querying related products
        if ($product) {
            $related_products = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id) 
                ->select('id', "name_{$locale} as name", 'price', 'discount', 'photo') 
                ->get();
        } else {
            $related_products = collect(); // Return an empty collection if no product is found
        }

        return view('website.cart', compact('product', 'related_products'));

    }

    public function addCart(Request $request) {

        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'size' => 'required|string',
            'color' => 'required|string',
            'quantity' => 'required|integer'

        ]);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);  // Default to 1 if not provided
        $color = $request->input('color');
        $size = $request->input('size');

        if($quantity == 0) {
            return redirect()->back();
        }

        if (auth()->check()) {
           // Authenticated user
            $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product_id)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

            if ($cartItem) {
                // If the cart item exists, update the quantity
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
            // If the cart item doesn't exist, create a new entry
            Cart::create([
                    'id' => Str::uuid(),
                    'user_id' => auth()->id(),
                    'product_id' => $product_id,
                    'color' => $color,
                    'size' => $size,
                    'quantity' => $quantity
                ]);
            }

        } else {
            // Unauthenticated user
            $cookie_id = $request->cookie('cart_id');

            // Generate a new UUID if the cookie does not exist
            if (!$cookie_id) {
                $cookie_id = Str::uuid();
                // Store the cookie with a 30-day expiration time
                cookie()->queue(cookie()->make('cart_id', $cookie_id, 60 * 24 * 30));  // 30 days
            }

            // Check if the cart item exists and update or create it
            $cartItem = Cart::where('cookie_id', $cookie_id)
                ->where('product_id', $product_id)
                ->where('color', $color)
                ->where('size', $size)
                ->first();

            if ($cartItem) {
                // If the cart item exists, update the quantity
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // If the cart item doesn't exist, create a new entry
                Cart::create([
                    'id' => Str::uuid(),
                    'cookie_id' => $cookie_id,
                    'product_id' => $product_id,
                    'color' => $color,
                    'size' => $size,
                    'quantity' => $quantity
                ]);
            }

        }

        return redirect()->back()->with('success', __('words.saveSucc'));
    

    }
}
