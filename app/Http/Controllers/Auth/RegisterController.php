<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // This method is triggered after successful registration
    protected function registered(Request $request, $user)
    {
        $this->mergeCarts($request, $user);
    }

    // Method to merge carts after registration
    protected function mergeCarts(Request $request, $user)
    {
        $cookie_id = $request->cookie('cart_id');

        // Retrieve unauthenticated cart items (based on cookie_id)
        $carts = Cart::where('cookie_id', $cookie_id)->get();

        // Loop through the unauthenticated cart items
        foreach ($carts as $cart) {
            // Directly associate the item with the authenticated user by setting user_id
            $cart->user_id = $user->id;
            $cart->cookie_id = null;  // Remove the cookie_id since it's now associated with a user
            $cart->save();
        }

        // Optionally, delete the cart_cookie_id cookie
        cookie()->queue(cookie()->forget('cart_id'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

     public function showRegistrationForm()
     {
        $locale = app()->getLocale();
        $governorates = Governorate::select('id', "governorate_{$locale} as name")->get();
         return view('auth.register', compact('governorates')); // Pass to the view
     }

     
    protected $redirectTo = '/website/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'regex:/^(010|011|012|015)\d{8}$/'],
            'governorate' => ['required', 'exists:governorates,id'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'governorate_id' => $data['governorate'],
            'status' => 'user',
        ]);
    }
}
