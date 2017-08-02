<?php

namespace App\Http\Controllers;

use App\Category;
use App\Manufacturer;
use App\Product;

class SlugController extends Controller
{
    public function route($slug)
    {
        if ($category = Category::where('slug', $slug)->get()->first()) {
            return app()->make(CategoryController::class)->callAction('show', [$category]);
        }

        if ($manufacturer = Manufacturer::where('slug', $slug)->get()->first()) {
            return app()->make(ManufacturerController::class)->callAction('show', [$manufacturer]);
        }
    }

    public function nestedRoute($slug1, $slug2)
    {

        if (($category = Category::where('slug', $slug2)->get()->first()) || ($category = Category::where('slug', $slug1)->get()->first())) {
            return app()->make(CategoryController::class)->callAction('show', [$category]);
        }

        if ($product = Product::where('slug', $slug2)->get()->first()) {
            return app()->make(ProductController::class)->callAction('show', [$product]);
        }

    }
}
