<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', ['productsCount' => Product::count(), 'categoriesCount' => Category::count(), 'usersCount' => User::count()]);
    }

    public function showProducts()
    {
        $products = Product::latest()->get();
        $category = new Category();
        return view('admin.products', ['products' => $products, 'subCategories' => $category->getOnlySubCategories()]);
    }

    public function showCategories()
    {
        $categories = Category::with('parentCategory')->orderBy('title')->get();
        return view('admin.categories', ['categories' => $categories]);
    }

    public function showUsers()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users', ['users' => $users]);
    }
    public function storeProducts(Request $request) {
        $paths = [];
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $this->genFileName($image->getClientOriginalExtension());
                $image->storeAs('public/images', $filename);
                array_push($paths, $filename);
            }
        }
        $data = $request->except('images', '_token');
        $data['images'] = json_encode($paths);
        Product::create($data);
        return back()->with('productAdded', 'Product Added');
    }
    public function deleteProducts($id) {
        $product = Product::find($id);
        $images = array_map(function($image) {
            return 'public/images/'.$image;
        }, $product->images);
        Product::destroy($id);
        Storage::delete($images);
        return back()->with('productDeleted', 'Product Deleted');
    }
    private function genFileName($extension) {
        return bin2hex(openssl_random_pseudo_bytes(20)).'.'.$extension;
    }
}
