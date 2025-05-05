<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','product_images')->get();
        $brands = Brand::get();
        $categories = Category::get();

        return Inertia::render('Admin/Product/index',['products'=>$products,'brands'=>$brands,'categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $product = new Product;

        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();

        //check if product has an image
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');

            foreach ($productImages as $image) {
                // generate a unique name for the image
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // move the image to the public folder
                $image->move('product_images', $uniqueName);

                // save image path in the database
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product Created Successfully');
    }
}
