<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class CategoryController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Category::query();
            return  Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                        $actionBtn = '<a  data-toggle="modal" data-target="#edit" data-id="' .$row->id . '" data-name="' .$row->name . '" data-image="' .asset($row->image) . '"  class="edit btn btn-success btn-sm text-light"><i class="fe fe-delete  fe-16"></i></a> 
                        <a data-toggle="modal" data-target="#delete" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm text-light" ><i class="fe fe-edit  fe-16"></i></a>';
                        return $actionBtn;
                })
                ->addColumn('image', function($row){
                    $photo = '<img src="' . asset($row->image) . '" style="max-width: 100px; height: 100px;">';
                    return $photo;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('dashboard.categories.index');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'image' => $request->image,
        ]);

        if ($request->file('image')) {
            $oldPath = public_path($category->image);
            $this->deleteFile($oldPath);
            $category->update(['image' => $this->upload($request->image)]);
        }
        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    
    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
            'image' => $request->image,
        ]);

        if ($request->file('image')) {
            $oldPath = public_path($category->image);
            $this->deleteFile($oldPath);
            $category->update(['image' => $this->upload($request->image)]);
        }
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        $category->delete();
        $oldPath = public_path($category->image);
        $this->deleteFile($oldPath);
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

}
