<?php

namespace App;

class Cart
{
    public static function getDefaultNullCartProduct()
    {
        return ['quantity' => 0];
    }

    public static function getProducts()
    {
        return Product::whereIn('id', array_keys(session('cart.products', [])))->get();
    }

    public static function addProduct($product, $quantity = 1)
    {
        $products = collect(session('cart.products'));
        $products[$product->id] = [
            'quantity' => self::getProductQuantity($product->id) + $quantity
        ];

        return ($product->quantity >= $products[$product->id]['quantity']) && (session(['cart.products' => $products->toArray()]) || true);
    }

    public static function getProductQuantity($id)
    {
        return collect(session('cart.products'))->get($id, self::getDefaultNullCartProduct())['quantity'];
    }

    public static function getSummaryPriceForProducts()
    {
        return round(collect(self::getProducts())->reduce(function($carry, $item) {
            return $carry + $item->getSummaryPriceInCart();
        }, 0), 2);

    }

    public static function removeProduct($productId)
    {
        session(['cart.products' => collect(session('cart.products'))->forget($productId)->toArray()]);

        return true;
    }

    public static function updateProduct($productId, $quantity)
    {
        $products = collect(session('cart.products'));
        $products[$productId] = [
            'quantity' =>  $quantity
        ];

        session(['cart.products' => $products->toArray()]);
        return true;
    }
}
