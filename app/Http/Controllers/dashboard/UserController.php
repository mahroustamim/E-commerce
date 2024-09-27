<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function getUsers(Request $request) {
        return $this->getRoleByStatus('user', $request);
    }

    public function getSupervisor(Request $request) {
        $this->authorize('is_admin');
        return $this->getRoleByStatus('supervisor', $request);
    }

    private function getRoleByStatus($status, Request $request) {
        $request->validate([
            'search' => 'string',
        ]);
    
        $search = $request->search;

        $query = User::Where('status', $status)
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
        return view("dashboard.users.$status", compact('users', 'search'));
    }

    public function create() {
        $this->authorize('is_admin');
        $locale = app()->getLocale();

        $governorates = Governorate::select('id', "governorate_{$locale} as name")->get();
        
        return view('dashboard.users.create_supervisor', compact('governorates'));
    }

    public function store(Request $request) {
        $this->authorize('is_admin');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => ['required', 'regex:/^(010|011|012|015)\d{8}$/'],
            'governorate' => 'required|exists:governorates,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'governorate_id' => $request->governorate,
            'password' =>  bcrypt($request->password),
            'email_verified_at' => now(),
            'status' => 'supervisor',
        ]);

        return redirect()->route('dashboard.supervisors')->with('success', __('words.saveSucc'));
    }

    public function edit($id) {
        $this->authorize('is_admin');

        $locale = app()->getLocale();

        $governorates = Governorate::select('id', "governorate_{$locale} as name")->get();

        $user = User::find($id);

        return view('dashboard.users.edit_supervisor', compact('user', 'governorates'));
    }

    public function update(Request $request, $id) {
        $this->authorize('is_admin');

        // Validation
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => ['required', 'regex:/^(010|011|012|015)\d{8}$/'],
            'governorate' => 'required|exists:governorates,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrfail($id);

        // Update user details
        $user->name = $request->name;
    
        // If email has changed, reset email_verified_at
        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = now(); // Reset email verification date
        } else {
            $user->email = $request->email;
        }
    
        $user->phone = $request->phone;
        $user->governorate_id = $request->governorate;
    
        // Update password only if a new one is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        // Save the user
        $user->save();
    
        return redirect()->route('dashboard.supervisors')->with('success', __('words.saveSucc'));

    }

    public function delete(Request $request) {
        $this->authorize('is_admin');

        User::find($request->id)->delete();

        return redirect()->back()->with('success', __('words.deleteSucc'));
    }
}
