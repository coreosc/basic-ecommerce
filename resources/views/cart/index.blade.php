@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('cart') !!}
        </div>

        <div class="row">
            <div class="col col-md-12">
                <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Koszyk</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nazwa produktu</th>
                                <th>Cena jednostkowa</th>
                                <th>Liczba</th>
                                <th>Razem</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">Razem produkty: @{{ summaryProducts }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                        <tr v-for="product in products">
                            <td>@{{ product.name }}</td>
                            <td>@{{ product.price }}</td>
                            <td><input v-model="product.quantity" type="number" :min="1" :max="product.inStockQuantity" :value="product.quantity" v-on:change="updateSession(product.id, product.quantity)" v-on:keyup="checkStockQuantity(product)"/></td>
                            <td>@{{ calculatePrice(product) }}</td>
                            <td><button v-on:click="removeFromCart(product.id)">X</button></td>
                        </tr>
                    </table>
                </div>
                <!-- Table -->
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"><a class="btn btn-default" href="/">&lt; Kontynuuj zakupy</a></div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-4"><a class="btn btn-primary" href="/koszyk/zaloguj-sie">Zaloguj się</a></div>
            <div class="col-md-4 text-center "><a class="btn btn-primary" href="/koszyk/zaloz-konto">Załóż konto</a></div>
            <div class="col-md-4 text-right"><a class="btn btn-primary" href="/koszyk/kup-bez-rejestracji">Kup bez rejestracji</a></div>
        </div>

    </div>

@endsection