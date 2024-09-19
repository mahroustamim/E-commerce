<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

class CartController extends Controller
{
    public function index($id) {

        $locale = app()->getLocale();

        $product = Product::where('id', $id)
        ->with('image')
        ->select('id', "name_{$locale} as name", 'category_id', "desc_{$locale} as desc", "brand_{$locale} as brand", 'price', 'discount', 'quantity', 'status', 'colors', 'sizes')
        ->first();
    
        // Paginate comments related to the product
        $comments = Comment::where('product_id', $id)->with('user')->latest() ->paginate(3); 

        // Get the average rating and count of ratings for the product
        $averageRating = Rating::where('product_id', $id)->avg('rating');
        $ratingCount = Rating::where('product_id', $id)->count();

        // $userRated = auth()->check() ? Rating::where('user_id', auth()->id())->where('product_id', $id)->exists() : false;
        if(auth()->check()) {
            $userRated = Rating::where('user_id', auth()->id())->where('product_id', $id)->select('rating')->first();
        } else {
            $userRated = false;
        }

        // Check if product exists before querying related products
        if ($product) {
            $related_products = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id) 
                ->select('id', "name_{$locale} as name", 'price', 'discount', 'photo') 
                ->get();
        } else {
            $related_products = collect(); // Return an empty collection if no product is found
        }

        return view('website.cart', compact('product', 'related_products', 'userRated', 'comments', 'averageRating', 'ratingCount'));

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


    public function rating(Request $request) {
        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|in:1,2,3,4,5',
        ]);

        if(!auth()->check()) {
            return redirect()->back();
        }
    
        // Check if the user has already rated the product
        $userId = auth()->id();
        $productId = $request->product_id;
    
        $existingRating = Rating::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    
        // If no existing rating, create a new rating
        if (!$existingRating) {
            Rating::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $request->rating,
            ]);
        }
    
        // Optionally, return a response
        return redirect()->back()->with('success', __('words.saveSucc'));
    }

    public function comment(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string',
        ]);

        if(!auth()->check()) {
            return redirect()->back();
        }

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'comment' => $request->comment,
        ]);

        // Optionally, return a response
        return redirect()->back()->with('success', __('words.saveSucc'));

    }


    public function shoppingCart(Request $request) {

        // Initialize $carts as an empty collection to avoid errors if no carts are found
        $carts = collect();
    
        if(auth()->check()) {
            // Get carts for authenticated users
            $carts = Cart::where('user_id', auth()->id())->get();
    
        } else {
            // Get carts for unauthenticated users using cookie_id
            $cookie_id = $request->cookie('cart_id');
            if($cookie_id) {
                $carts = Cart::where('cookie_id', $cookie_id)->get();
            }
        }
        return view('website.shopping_cart', compact('carts'));
    }

    public function delete(Request $request, $id) {

        Cart::where('id', $id)->delete();

        if(!auth()->check()) {
            $cookie_id = $request->cookie('cart_id');
            if($cookie_id) {
                cookie()->queue(cookie()->forget('cart_id'));
            }
        }

        return response()->json(['success' => true, 'message' => __('words.saveSucc')]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'quantity' => 'string',
        ]);
        if($request->quantity == 0) {
            return redirect()->back();
        }
        $cart = Cart::where('id', $id)->first();
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json(['success' => true, 'message' => __('words.saveSucc')]);
    }
    
    
}
