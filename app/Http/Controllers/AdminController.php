<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $category = new Category();
        $categories = $category->with('parentCategory')->orderBy('title')->get();
        $subCategories = $category->getOnlySubCategories();
        return view('admin.categories', ['categories' => $categories, 'subCategoriesCount' => $subCategories->count()]);
    }

    public function showUsers()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users', ['users' => $users]);
    }
    public function storeUser(Request $request)
    {
        $data = $request->except('_token', '_method');
        $validator = Validator::make($data, ['email' => 'unique:users']);
        if($validator->fails()) {
            return back()->with('userValidation', 'The user already exists.')->withInput();
        }
        $password = bin2hex(openssl_random_pseudo_bytes(5));
        $data['password'] = Hash::make($password);
        $user = User::create($data);
        return back()->with('userAdded', $password);
    }
    public function updateUser($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->except('_token', '_method'));
        return back()->with('userUpdated', 'User Updated');
    }
    public function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('userDeleted', 'User Deleted');
    }
    public function storeProducts(Request $request) {
        $data = $request->except('images', '_token');
        $data['images'] = json_encode($this->storeAndGetProductImages($request));
        Product::create($data);
        return back()->with('productAdded', 'Product Added');
    }
    public function updateProducts($id, Request $request) {
        $product = Product::find($id);
        // remove deleted images from disk
        if($product->images && !$request->existing_images) {
            $images = array_map(function($image) {
            return 'public/images/'.$image;
            }, $product->images);
            Storage::delete($images);
            // product images have mutators that uses json_decode
            $product->images = json_encode([]);
        }
        // store uploaded images to disk
        $data = $request->except('images', '_token', 'existing_images');

        $data['images'] = json_encode(array_merge($product->images, $this->storeAndGetProductImages($request)));
        $product->update($data);
        return back()->with('productUpdated', 'Product Updated');
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
    public function deleteCategories($id) {
        Category::destroy($id);
        return back()->with('categoryDeleted', 'Category Deleted');
    }
    public function storeCategories(Request $request) {
        Category::create($request->except('_token', '_method'));
        return back()->with('categoryAdded', 'Category Added');
    }
    public function updateCategories($id, Request $request) {
        $category = Category::find($id);
        $category->update($request->except('_token', '_method'));
        return back()->with('categoryUpdated', 'Category Updated');
    }
    private function storeAndGetProductImages(Request $request) {
        $paths = [];
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $this->genFileName($image->getClientOriginalExtension());
                $image->storeAs('public/images', $filename);
                array_push($paths, $filename);
            }
        }
        return $paths;
    }
    private function genFileName($extension) {
        return bin2hex(openssl_random_pseudo_bytes(20)).'.'.$extension;
    }
}
