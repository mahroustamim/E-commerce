<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class ProductImageController extends Controller
{
    use UploadImage;
    
    public function images($id)
    {
        $images = Image::where('product_id', $id)->paginate(3);
        return view('dashboard.products.images', compact('id', 'images'));
    }

    public function storeImages(Request $request, $id)
    {
        $request->validate([
            'name.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = $request->file('name');

        if ($request->hasFile('name')) {

            foreach($images as $image) {
                $filename = $this->upload($image);

                Image::create([

                    'name' => $filename,
                    'product_id' => $id,

                ]);

            }

        }
        return back()->with('success', 'تم تحميل الصور بنجاح');
    }

    public function deleteImages(Image $image)
    {
        $image->delete();
        $path = public_path($image->name);
        $this->deleteFile($path);
        return back()->with('success', 'تم حذف الصورة بنجاح');
    }
}
