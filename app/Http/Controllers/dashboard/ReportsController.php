<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index() {

        $pending = Order::where('status', 'pending')->count();
        $delivering = Order::where('status', 'delivering')->count();
        $completed = Order::where('status', 'completed')->count();


        return view('dashboard.reports.reports', compact('pending', 'delivering', 'completed'));
    }
}
