<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'default_category_id');
    }

    public function forDisplayProducts()
    {
        return $this->products()->where('active', true)->where('quantity', '>', 0);
    }

    public function getPath()
    {
        return '/' . ($this->category ? $this->category->slug . '/' . $this->slug : $this->slug);
    }
}
