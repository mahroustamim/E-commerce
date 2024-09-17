<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    // This method is triggered after successful login
    protected function authenticated(Request $request, $user)
    {
        $this->mergeCarts($request, $user);
    }

    // Method to merge carts after login
    protected function mergeCarts(Request $request, $user)
    {
        $cookie_id = $request->cookie('cart_id');

        // Retrieve unauthenticated cart items (based on cookie_id)
        $guestCartItems = Cart::where('cookie_id', $cookie_id)->get();

        // Loop through the unauthenticated cart items
        foreach ($guestCartItems as $guestCartItem) {
            // Check if the item already exists in the authenticated user's cart
            $existingCartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $guestCartItem->product_id)
                ->where('color', $guestCartItem->color)
                ->where('size', $guestCartItem->size)
                ->first();

            if ($existingCartItem) {
                // If it exists, update the quantity
                $existingCartItem->quantity += $guestCartItem->quantity;
                $existingCartItem->save();
            } else {
                // If it doesn't exist, assign the user_id to the guest cart item and save it
                $guestCartItem->user_id = $user->id;
                $guestCartItem->cookie_id = null;  // Remove the cookie_id since it's now associated with a user
                $guestCartItem->save();
            }
        }

        // Optionally, delete the cart_cookie_id cookie
        cookie()->queue(cookie()->forget('cart_id'));
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (Auth::user()->status === 'admin' || Auth::user()->status === 'supervisor')
            return '/dashboard/home';
        else 
            return '/website/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
