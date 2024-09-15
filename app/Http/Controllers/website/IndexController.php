<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Product;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Laravel\Ui\Presets\React;
use Symfony\Contracts\Service\Attribute\Required;

class IndexController extends Controller
{
    // ===============================================================================
    public function index() {

        $locale = app()->getLocale();

        $categories = Category::select('id', "name_{$locale} as name", 'image')->withCount('products')->get(6);

        $products = Product::select('id', "name_{$locale} as name", 'photo', 'price', 'discount')->get(12);

        return view('website.index', compact('categories', 'products'));

    }

    // ===============================================================================
    // ===============================================================================

    public function categories(Request $request) {

        $name = $request->name;

        $locale = app()->getLocale();

        // Validation rules for search filters
        $request->validate([
            'name' => 'nullable|string',
            'price' => 'nullable|array',
            'price.*' => 'in:all,0-100,100-200,200-300,300-400,400-500',
            'colors' => 'nullable|array',
            'colors.*' => 'in:all,black,white,red,blue,green,yellow,orange,grey,olive',
            'sizes' => 'nullable|array',
            'sizes.*' => 'in:all,XS,S,M,L,XL',
        ]);
    
        // Query to fetch products
        $query = Product::query();

        $categories = Category::select('id', "name_{$locale} as name", 'image')->withCount('products')->paginate(9);

        return view('website.categories', compact('categories'));
    }

    // ===============================================================================
    // ===============================================================================

    public function products(Request $request) {

        $locale = app()->getLocale(); 

        $name = $request->name;

        $request->validate([
            'name' => 'nullable|string',
            'price' => 'nullable|array',
            'price.*' => 'in:all,0-100,100-200,200-300,300-400,400-500',
            'colors' => 'nullable|array',
            'colors.*' => 'in:all,black,white,red,blue,green,yellow,orange,grey,olive',
            'sizes' => 'nullable|array',
            'sizes.*' => 'in:all,XS,S,M,L,XL',
        ]);
    
        // Query to fetch products
        $query = Product::query();
    
        // Filter by product name
        if ($request->filled('name')) {  
            $query->where("name_{$locale}", 'like', '%' . $request->name . '%');
        }
    
        // Handle price filtering
        if ($request->filled('price') && !in_array('all', $request->price)) {
            $priceRanges = [
                '0-100'     => [0, 100],
                '100-200'   => [100, 200],
                '200-300'   => [200, 300],
                '300-400'   => [300, 400],
                '400-500'   => [400, 500],
            ];
    
            // Use a where clause to filter products based on price range
            $query->where(function ($query) use ($request, $priceRanges) {
                foreach ($request->price as $range) {
                    if (isset($priceRanges[$range])) {
                        $query->orWhereBetween('price', $priceRanges[$range]);
                    }
                }
            });
        }

        if ($request->filled('colors') && !in_array('all', $request->colors)) {
            foreach($request->colors as $color) {
                $query->WhereJsonContains('colors', $color);
            }
        }

        // Handle size filtering
        if ($request->filled('sizes') && !in_array('all', $request->sizes)) {
            foreach ($request->sizes as $size) {
                $query->whereJsonContains('sizes', $size);
            }
        }

        $products = $query->select('id', "name_{$locale} as name", 'photo', 'price', 'discount')->paginate(9);

       return view('website.products', compact('products', 'name'));
    }

    // ===============================================================================
    // ===============================================================================

    public function about() {
        return view('website.about');
    }

    // ===============================================================================
    // ===============================================================================

    public function contact() {
        return view('website.contact');
    }

    public function sendContact(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        $contactData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        Mail::to('mahroustamim@gmail.com')->send(new ContactMail($contactData));
        return redirect()->back()->with('success', __('words.sendSucc') );
    }

    // ===============================================================================
    // ===============================================================================

}
