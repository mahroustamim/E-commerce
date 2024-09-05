<?php

namespace App\Http\Controllers\wesite;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $locale = app()->getLocale();

        $categories = Category::select('id', "name_{$locale} as name", 'image')->withCount('products')->get(6);

        $products = Product::select('id', "name_{$locale} as name", 'photo', 'price', 'discount')->get(12);

        return view('website.index', compact('categories', 'products'));

    }
}
