<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        if($product->getPath() !== request()->getPathInfo()) {
            return redirect($product->getPath(), 301);
        }

        return view('product.show', ['product' => $product]);

    }
}
