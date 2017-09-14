<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\Register;
use App\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register.form');
    }

    public function processRegistrationForm(Register $request)
    {
        User::create($request->all());

        if(Cart::getSummaryPriceForProducts() > 0 ) {
            return redirect()->route('checkout');
        } else {
            // @TODO: moje konto
            return redirect('/');
        }
    }

}
