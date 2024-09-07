<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

        
            $query = Product::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('dashboard.products.edit', $row->id) . '">'. __('words.edit') .'</a>
                                <a class="dropdown-item" href="#delete" data-toggle="modal" data-id = "'. $row->id .'">'. __('words.delete') .'</a>
                                <a class="dropdown-item" href="#status" data-toggle="modal" data-id = "'. $row->id .'">'. __('words.changeStatus') .'</a>
                            </div>

                    ';
                    return $actionBtn;
                })
                ->addColumn('category_name', function($row) {
                    $locale = app()->getLocale();
                    return $row->category ? $row->category->{'name_' . $locale} : 'No Category';
                })
                ->addColumn('photo', function($row) {
                    return '<img src="' . asset('images/products/main/' . $row->photo) . '" style="max-width: 100px; height: 100px;">';
                })                
                ->addColumn('status', function($row) {
                    if($row->status === 'available') {
                        return '<span class="badge badge-success text-light p-2" style="font-size: 20px;">'. __('words.' . $row->status) .'</span>';
                    } else {
                        return '<span class="badge badge-warning text-light p-2" style="font-size: 20px;">'. __('words.' . $row->status) .'</span>';
                    }
                })                             
                ->rawColumns(['action', 'photo', 'status'])
                ->make(true);
        }
        
        return view('dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $local = app()->getLocale();
        $categories = Category::select('id', "name_{$local} as name")->get();
        return view('dashboard.products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'brand_en' => 'required|string|max:255',
            'brand_ar' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'colors' => 'required|array',
            'colors.*' => 'string',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:XS,S,M,L,XL,2XL,3XL,4XL',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        // Handle the main product photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $path = Str::uuid() .'.'.$extension;
            $file->move(public_path('images/products/main'), $path);
        }

        // Prepare the data for product creation
        $data = [
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'brand_en' => $request->brand_en,
            'brand_ar' => $request->brand_ar,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'colors' => $request->colors,
            'sizes' => $request->sizes,
            'desc_en' => $request->desc_en,
            'desc_ar' => $request->desc_ar,
            'creator' => auth()->user()->name,
        ];

        // Include the main product photo in the data if it was uploaded
        if (isset($path)) {
            $data['photo'] = $path;
        }

        // Create the product
        $product = Product::create($data);
        $productId = $product->id;

        // Handle the multiple image uploads
        if ($request->hasFile('name')) {
            foreach ($request->file('name') as $file) {
                $extension = $file->getClientOriginalExtension();
                $path = Str::uuid() .'.'.$extension;
                $file->move(public_path('images/products/' . $productId), $path);
                Image::create([
                    'name' => $path,
                    'product_id' => $productId,
                ]);
            }
        }

        // Redirect back to the products index with a success message
        return redirect()->route('dashboard.products.index')->with('success', __('words.saveSucc'));
        
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
    public function edit(string $id)
    {
        $local = app()->getLocale();
        $categories = Category::select('id', "name_{$local} as name")->get();
        $product = Product::find($id);
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);;
        // Validate the request data
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'brand_en' => 'required|string|max:255',
            'brand_ar' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'colors' => 'required|array',
            'colors.*' => 'string',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:XS,S,M,L,XL,2XL,3XL,4XL',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'name' => 'required|array',
            'name.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        // Handle the main product photo upload
        if ($request->hasFile('photo')) {
            if($product->photo) {
                $oldPhotoPath = 'images/products/main/' . $product->photo;
                if(file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }


            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $path = Str::uuid() .'.'.$extension;
            $file->move(public_path('images/products/main'), $path);
        }

        // Prepare the data for product creation
        $data = [
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'brand_en' => $request->brand_en,
            'brand_ar' => $request->brand_ar,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'colors' => $request->colors,
            'sizes' => $request->sizes,
            'desc_en' => $request->desc_en,
            'desc_ar' => $request->desc_ar,
            'creator' => auth()->user()->name,
        ];

        // Include the main product photo in the data if it was uploaded
        if (isset($path)) {
            $data['photo'] = $path;
        }

        $product->update($data);
        $images = $product->image;

        if ($request->hasFile('name')) {

            if($images) {
                foreach ($images as $image) {
                    $image->delete();
                }

                $oldImagesPath = public_path('images/products/' . $id);

                if(File::isDirectory($oldImagesPath)) {
                    File::deleteDirectory($oldImagesPath);
                }
                
            }

            foreach ($request->file('name') as $file) {
                $extension = $file->getClientOriginalExtension();
                $path = Str::uuid() .'.'.$extension;
                $file->move(public_path('images/products/' . $id), $path);
                Image::create([
                    'name' => $path,
                    'product_id' => $id,
                ]);
            }
        }

        // Redirect back to the products index with a success message
        return redirect()->route('dashboard.products.index')->with('success', __('words.saveSucc'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request) {
        $id = $request->id;
        $product = Product::find($id);
        $images = $product->image;

        // delete main photo
        if($product->photo) {
            $oldPhotoPath = 'images/products/main/' . $product->photo;
            if(file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
    
        if ($images) {
            $path = public_path('images/products/' . $id);
            
            // Delete each image
            foreach ($images as $image) {
                $image->delete();
            }
    
            // Delete the directory if it's empty
            if (File::isDirectory($path)) {
                File::deleteDirectory($path);
            }
        }
    
        $product->delete();
        return redirect()->back()->with('success', __('words.deleteSucc'));
    }

    public function changStatus(Request $request) {
        $request->validate([
            'status' => 'required|in:available,unavailable',
        ]);

        $product = Product::find($request->id);

        $product->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', __('words.saveSucc'));
    }
}
