<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductDetails;
use App\Models\Size;
use Illuminate\Http\Request;

class ColorSizeController extends Controller
{
    public function index($id) 
    {
        $colors = Color::all();
        $sizes = Size::all();
        $colors_sizes = ProductDetails::all();
        return view('dashboard.products.colors_sizes', compact('id', 'colors', 'sizes', 'colors_sizes'));
    }
    
    public function store(Request $request, $id)
    {
        $request->validate([
            'color' => 'required|array', 
            'color.*' => 'required|numeric', //Validates each element of the array
            'size' => 'required|array',
            'size.*' => 'required|numeric',
        ]);
        $colors =  $request->color;
        $sizes =  $request->size;
        $x = count($sizes);

        foreach ($colors as $color) {
                ProductDetails::updateOrCreate([
                    'product_id' => $id,
                    'color_id' => $color,
                ]);
        }

        foreach ($sizes as $size) {
            ProductDetails::updateOrCreate([
                'product_id' => $id,
                'size_id' => $size,
            ]);
        }
        return back()->with('success', 'تم بنجاح');
    }
}
