<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','product_images');
        $filterProducts = $products->filtered()->paginate(9)->withQueryString();

        $categories = Category::get();
        $brands = Brand::get();

        return Inertia::render('User/ProductList',
        [
            'categories'=>$categories,
            'brands'=>$brands,
            'products'=> ProductResource::collection($filterProducts)
        ]
    );
    }
}
