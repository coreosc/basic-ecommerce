@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('product', $product) !!}
        </div>

        <div class="row">
            <div class="col col-lg-12">
                <h1>{{$product->name}}</h1>
                <p>{{$product->description}}</p>
                <button v-on:click="addToCart({
                        id: {{$product->id}},
                        name: '{{ $product->name }}',
                        price: '{{ $product->price() }}',
                        quantity: 1,
                        inStockQuantity: {{$product->quantity}},
                        summaryPrice: {{$product->getSummaryPriceInCart()}}
                        })">Dodaj do koszyka
                </button>
            </div>
        </div>

    </div>
@endsection

