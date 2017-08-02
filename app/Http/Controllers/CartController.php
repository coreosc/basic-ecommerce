<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;

class CartController extends Controller
{

    function index()
    {
        return view('cart.index', [
            'products'        => Cart::getProducts(),
            'summaryProducts' => Cart::getSummaryPriceForProducts()
        ]);
    }

    function cartState()
    {
        return [
            'products'        => collect(Cart::getProducts())->map(function ($product) {
                return [
                    'id'              => $product->id,
                    'name'            => $product->name,
                    'price'           => $product->price(),
                    'quantity'        => $product->getInCartQuantity(),
                    'inStockQuantity' => $product->quantity,
                    'summaryPrice'    => $product->getSummaryPriceInCart(),
                ];
            }),
            'summaryProducts' => Cart::getSummaryPriceForProducts()
        ];
    }

    /**
     * @TODO: Walidacja
     */
    function updateCart()
    {
        if(request('quantity') == 0){
            Cart::removeProduct(request('id'));
        }

        Cart::updateProduct(request('id'), request('quantity'));
    }

    function add(Product $product)
    {
        return [
            'success'      => Cart::addProduct($product),
            'minicartHtml' => (string)(view()->make('cart.partials.minicart', ['products' => Cart::getProducts()]))
        ];
    }

    function remove(Product $product)
    {
        return [
            'success'      => Cart::removeProduct($product),
            'minicartHtml' => (string)(view()->make('cart.partials.minicart', ['products' => Cart::getProducts()]))
        ];
    }

}
