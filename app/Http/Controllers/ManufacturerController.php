<?php

namespace App\Http\Controllers;

use App\Manufacturer;

class ManufacturerController extends Controller
{
    public function show(Manufacturer $manufacturer)
    {
        if($manufacturer->getPath() !== request()->getPathInfo()) {
            return redirect($manufacturer->getPath(), 301);
        }

        return view('manufacturer.show', ['manufacturer' => $manufacturer, 'products' => $manufacturer->products()->paginate(2)]);

    }
}
