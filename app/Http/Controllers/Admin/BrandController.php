<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return Inertia::render('Admin/Brand/Brand', [
            'brands' => $brands
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $Brand)
    {
        return Inertia::render('brands/Edit', ['Brand' => $Brand]);
    }

    public function update(Request $request, $id)
    {
        // Find the Brand by id or fail if not found
        $Brand = Brand::findOrFail($id);

        // Validate the request data (optional but recommended)
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $Brand->id,
        ]);

        // Update the Brand name
        $Brand->name = $request->name;

        // Save the updated Brand
        $Brand->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Brand updated successfully');
    }

    public function destroy($id)
    {
        $Brand = Brand::findOrFail($id);
        $Brand->delete();

        return redirect()->back()->with('success', 'Brand deleted successfully');
    }
}
