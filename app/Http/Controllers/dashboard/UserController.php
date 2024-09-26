<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {

        $request->validate([
            'search' => 'string',
        ]);
    
        $search = $request->search;

        $query = User::Where('status', 'user')
            ->with('governorate')
            ->withSum('orders', 'total_price')
            ->withCount('orders')
            ->orderBy('orders_count', 'DESC');

        if($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', $search)

                    ->orWhereHas('governorate', function($q) use ($search) {
                        $q->where('governorate_en', 'like', '%' . $search . '%')
                            ->orWhere('governorate_ar', 'like', '%' .$search . '%');
                    });
                });

        }

        $users = $query->paginate(10);
        return view('dashboard.users.users', compact('users'));
    }
}
