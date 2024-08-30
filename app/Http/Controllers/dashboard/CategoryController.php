<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

        
            $query = Category::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editBtn = '<a href="' . route('dashboard.categories.edit', $row->id) . '" class="edit btn btn-success btn-sm text-light"><i class="fe fe-edit fe-16"></i></a>';
                    $deleteBtn = '<a href="#exampleModal" data-toggle="modal" class="delete btn btn-danger btn-sm text-light" data-id="' . $row->id . '"><i class="fe fe-delete fe-16"></i></a>';
                    return $editBtn . ' ' . $deleteBtn;
                })                
                ->addColumn('image', function($row){
                    return '<img src="' . asset('images/categories/' . $row->image) . '" style="max-width: 100px; height: 100px;">';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        
        return view('dashboard.categories.index');


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:categories,name_en',
            'name_ar' => 'required|string|max:255|unique:categories,name_ar',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $path = Str::uuid() .'.'.$extension;
            $file->move(public_path('images/categories'), $path);
        }

        $data = [
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
        ];

        if (isset($path)) {
            $data['image'] = $path;
        }

        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success', __('words.saveSucc'));
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
        $category = Category::find($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $category = Category::find($id);

    $request->validate([
        'name_en' => 'required|string|max:255|unique:categories,name_en,' . $category->id,
        'name_ar' => 'required|string|max:255|unique:categories,name_ar,' . $category->id,
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($category->image) {
            $oldImagePath = public_path('images/categories/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Save the new image
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $path = Str::uuid() . '.' . $extension;
        $file->move(public_path('images/categories/'), $path);

        // Update the data array with the new image path
    }

    // Prepare the data array for updating the category
    $data = [
        'name_en' => $request->name_en,
        'name_ar' => $request->name_ar,
    ];

    if (isset($path)) {
        $data['image'] = $path;
    }

    // Update the category in the database
    $category->update($data);

    return redirect()->route('dashboard.categories.index')->with('success', __('words.updateSucc'));
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
        $category = Category::find($id);

        if ($category->image) {
            $path = public_path('images/categories/' . $category->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $category->delete();
        return redirect()->back()->with('success', __('words.deleteSucc'));
    }
}
