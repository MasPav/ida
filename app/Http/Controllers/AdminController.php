<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\User;
use App\Models\Category;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard', ['productsCount' => Product::count(), 'categoriesCount' => Category::count(), 'usersCount' => User::count()]);
    }

    public function showProducts() {
        $products = Product::latest()->get();
        return view('admin.products', ['products' => $products]);
    }

    public function showCategories() {
        $categories = Category::with('parentCategory')->orderBy('title')->get();
        return view('admin.categories', ['categories' => $categories]);
    }

    public function showUsers() {
        $users = User::orderBy('name')->get();
        return view('admin.users', ['users' => $users]);
    }
}
