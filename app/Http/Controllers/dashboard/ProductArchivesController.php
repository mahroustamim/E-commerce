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
                ->addColumn('action', function($row) {
                    $actionBtn = '';
                    
                    $actionBtn .= '<a class="btn btn-sm btn-primary text-light" data-toggle="modal" href="#restore" data-id="' . $row->id . '">إسترجاع</a>';
                    $actionBtn .= '<span class="text-white">...</span>';
                    $actionBtn .= '<a class="btn btn-sm btn-danger text-light" data-toggle="modal" href="#delete" data-id="' . $row->id . '">حذف</a>';
                    
                    return $actionBtn;
                })            
                ->addColumn('category_name', function($row) {
                    return $row->category ? htmlspecialchars($row->category->name) : 'No Category';
                })
                ->addColumn('status', function($row) {
                    $status = $row->status;
                    $badgeClass = 'success'; 
                    if($status == 'غير متوفر') {
                        $badgeClass = 'warning';
                    }
                    return '<span class="badge badge-' . $badgeClass . '" style="font-size: 16px;">'. $status .'</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('dashboard.products.archives');
    }

    public function restore(Request $request)
    {
        $id = $request->id;
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect()->back()->with('success', 'تم إسترجاع المنتح بنجاح');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $product = Product::withTrashed()->find($id);
        $product->forceDelete();
        return redirect()->back()->with('success', 'تم حذف المنتح بنجاح');
    }
}
