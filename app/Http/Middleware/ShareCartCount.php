<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareCartCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $carts_count = 0;
        
        if (auth()->check()) {
            // Authenticated user
            $carts_count = Cart::where('user_id', auth()->id())->count();
        } else {
            // Unauthenticated user (use cookie ID)
            $cookie_id = $request->cookie('cart_id');
            if ($cookie_id) {
                $carts_count = Cart::where('cookie_id', $cookie_id)->count();
            }
        }

        // Share the cart count with all views
        View::share('carts_count', $carts_count);

        return $next($request);
    }
}
