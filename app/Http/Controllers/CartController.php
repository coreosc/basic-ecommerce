<?php

namespace App\Http\Controllers;

use App\Cart;

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
        if (request('quantity') == 0) {
            Cart::removeProduct(request('id'));

            return;
        }

        Cart::updateProduct(request('id'), (int)request('quantity'));
    }

}
