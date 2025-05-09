<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','product_images')->get();
        
        return Inertia::render('User/ProductList',
        [
            'products'=>$products
        ]
    );
    }
}
