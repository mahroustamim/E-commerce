<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function pending(Request $request) {
        return $this->getOrdersByStatus('pending', $request);
    }

    public function delivering(Request $request) {
        return $this->getOrdersByStatus('delivering', $request);
    }

    public function completed(Request $request) {
        return $this->getOrdersByStatus('completed', $request);
    }

    private function getOrdersByStatus($status, Request $request) {
        $request->validate([
            'search' => 'string',
        ]);
    
        $search = $request->search;
    
        // Create a base query for orders with a pending status
        $query = Order::where('status', $status)->with('address');
    
        // Check if a search term was provided
        if ($search) {
            // Search within the orders table for total_price
            $query->where(function ($q) use ($search) {
                $q->where('total_price', 'like', '%' . $search . '%')
                    ->orWhere('payment_method', 'like', '%' . $search . '%')
                    ->orWhere('number', $search)
    
                  // Join the addresses table and search within the name or phone fields in addresses
                  ->orWhereHas('address', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
    
                        // Join the governorates table and search within governorate_en
                        ->orWhereHas('governorate', function($q) use ($search) {
                            $q->where('governorate_en', 'like', '%' . $search . '%')
                                ->orWhere('governorate_ar', 'like', '%' . $search . '%');
                        });
                  });
            });
        }
    
        // Paginate the results
        $orders = $query->paginate(10);
    
        // Return the view with the orders and search term
        return view("dashboard.orders.$status", compact('orders', 'search'));
    }

    public function changeStatus(Request $request, $id) {

        $request->validate([
            'status' => 'required|string|in:completed,delivering'
        ]);

        $order = Order::where('id', $id)->first();
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', __('words.saveSucc'));

    }
    
}
