<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','product_images');
        $filterProducts = $products->filtered()->paginate(9)->withQueryString();
        
        return Inertia::render('User/ProductList',
        [
            'products'=> ProductResource::collection($filterProducts)
        ]
    );
    }
}
