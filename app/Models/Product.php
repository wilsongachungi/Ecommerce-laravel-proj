<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;
    protected $fillable = [
        'title',
        'slug',
        'quantity',
        'description',
        'published',
        'inStock',
        'price',
        'created_by',
        'updated_by',
        'brand_id',
        'category_id',
        'deleted_by',
    ];


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    //
}
