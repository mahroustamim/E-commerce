<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {

        $orders = Order::with('address')->latest()->take(5)->get();

        $orders_count = $orders->count();
        $sales = $orders->sum('total_price');
        $orders_avg = $orders->avg('total_price');
        $products_count = Product::count();

        $users = User::where('status', 'user')->count();
        $supervisors = User::where('status', 'supervisor')->count();
        $categories_count = Category::count();


        return view('dashboard.index', compact('orders_count', 
                                                'sales', 
                                                'orders_avg', 
                                                'products_count', 
                                                'users', 
                                                'supervisors', 
                                                'categories_count',
                                                'orders'));
    }
}
