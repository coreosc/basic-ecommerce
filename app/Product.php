<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function defaultCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function getInCartQuantity()
    {
        return Cart::getProductQuantity($this->id);
    }

    public function price()
    {
        return round($this->price * (1 + $this->vat / 100), 2);
    }

    public function getSummaryPriceInCart()
    {
        return round($this->getInCartQuantity() * $this->price * (1 + $this->vat / 100), 2);

    }

    public function getPath()
    {
        return '/' . $this->manufacturer->slug . '/' . $this->slug;
    }
}
