<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Sail\Console\AddCommand;
use PhpParser\Node\Stmt\Break_;
use Yajra\DataTables\Facades\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Product::with('category'); // Eager load the category relationship

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        التفاصيل
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="' . route('dashboard.products.edit', $row->id) . '">تعديل</a>
                        <a class="dropdown-item" data-toggle="modal" href="#delete" data-id="' . $row->id . '" >حذف</a>
                        <a class="dropdown-item" data-toggle="modal" href="#status" data-id="' . $row->id . '" >تغير الحالة</a>
                        <a class="dropdown-item" href="#">إضافة صور</a>
                        <a class="dropdown-item" href="#">الالوان والاحجام</a>
                        <a class="dropdown-item" href="#"></a>
                    </div>
                </div>
                ';
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
    return view('dashboard.products.index');
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('dashboard.products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string'
        ]);
        
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'desc' => $request->desc,
        ]);

        return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produt = Product::find($id);
        $request->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string'
        ]);

        $produt->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'desc' => $request->desc,
        ]);
        return redirect()->back()->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
    }

    public function changStatus(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $id = $request->id;
        $product = Product::find($id);
        $product->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'تم بنجاح');
    }

}
