<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $category;
    protected $product;
    public function __construct()
    {
        $this->category = new CategoryController(new Category);
        $this->product = new Product();
    }
    public function index()
    {
        // $product = $this->product->find(4);
        // $product->images = json_encode(["9778190_samsung-ue590-series-28-led-4k-uhd-monitor-box-kenya-mombasa-kisumu-nairobi-kericho-tech-nuggets_600x600.webp", "9778191_maxresdefault-2_300x169.webp", "9778193_4841949-samsung-lu28r550-tinhte-4_300x200.webp"]);
        // return $product->save();
        $categories = $this->category->index();
        $products = $this->product->latest()->get();
        return view('products', ['categories' => $categories, 'products' => $products]);
    }

    public function showProductDetails($id)
    {
        $product = $this->product->with('category')->find($id);
        $related = $product->relatedProducts($product->category_id, $product->id);
        return view('product-details', ['product' => $product, 'relatedProducts' => $related]);
    }

    public function search(Request $request)
    {
        $conditions = [];
        if ($request->has('category_id')) {
            $conditions = [['category_id', '=', $request->category_id]];
        }
        return $this->product->where($conditions)->latest()->get();
    }
}
