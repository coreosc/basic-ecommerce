<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function checkout()
    {

        return view('checkout.checkout', [
            'deliveries' =>
                collect([
                    ['id' => 1, 'name' => 'Odbiór osobisty', 'price' => 0, 'cod' => true, 'price_cod' => 0, 'type' => 'local_address'],
                    ['id' => 2, 'name' => 'Kurier', 'price' => 15.00, 'cod' => true, 'price_cod' => 8.5,  'type' => 'full_address'],
                    ['id' => 3, 'name' => 'Paczka w ruchu', 'price' => 8.9, 'cod' => false, 'type' => 'plugin:paczkawruchu'],
                    ['id' => 4, 'name' => 'Poczta polska', 'price' => 12.00, 'cod' => false, 'type' => 'full_address']
                ])->mapWithKeys(function($item) { return [ $item['id'] => $item ]; }),

            'localStorages' => collect([
                ['id' => 1, 'name' => 'Enfant Łódź', 'street' => 'Piotrkowska', 'street_number' => 270, 'flat_number' => '8.02', 'post_code' => '90-361', 'city' => 'Łódź']
            ]),

            'myAddresses' => collect([
//                ['id' => 1, 'first_name' => 'Kamil', 'last_name' => 'Pawlik', 'street' => 'Piotrkowska', 'street_number' => 270, 'flat_number' => '8.02', 'post_code' => '90-361', 'city' => 'Łódź', 'phone' => '123123123']
            ]),

        ]);
    }

}
