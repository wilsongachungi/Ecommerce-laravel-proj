<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Qui fugiat irure cupidatat mollit adipisicing.',
            'price'=>500.23,
            'quantity'=> 20,
            'category_id'=> 1,
            'brand_id' => 1,
            'description' => 'Excepteur enim duis et cupidatat fugiat et ex culpa minim officia exercitation dolor. Pariatur duis aliqua incididunt elit in minim non. Duis consequat velit mollit non deserunt excepteur reprehenderit in in ad magna non aliqua duis. Qui commodo quis minim ex anim do laborum tempor est commodo exercitation et dolor. Sit cillum deserunt duis fugiat ad nisi.'
        ]);
    }
}
