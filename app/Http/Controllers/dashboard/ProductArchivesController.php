<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class ProductArchivesController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Product::onlyTrashed()->with('category')->get(); // Eager load the category relationship

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '';
                $actionBtn .= '<a class="btn btn-primary">إسترجاع</a>';
                $actionBtn .= '<a class="btn btn-danger">حذف</a>';
                return $actionBtn;
            })
            ->addColumn('category_name', function($row) {
                return $row->category ? htmlspecialchars($row->category->name) : 'No Category';
            })
            ->addColumn('status', function($row) {
                $status = $row->status;
                $badgeClass = 'success'; 
                if($status == 'غير متوفر') {
                    $badgeClass = 'danger';
                }
                return '<span class="badge badge-' . $badgeClass . '" style="font-size: 16px;">'. $status .'</span>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    return view('dashboard.products.archives');
}
}
