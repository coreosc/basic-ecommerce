<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        if($category->getPath() !== request()->getPathInfo()) {
            return redirect($category->getPath(), 301);
        }

        return view('category.show', ['category' => $category, 'products' => $category->forDisplayProducts()->paginate(2)]);

    }
}
