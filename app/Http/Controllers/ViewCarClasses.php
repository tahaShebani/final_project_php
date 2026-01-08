<?php

namespace App\Http\Controllers;

use App\Models\CarClass;
use App\Models\Location;
use Illuminate\Http\Request;

class ViewCarClasses extends Controller
{
    public function viewAll(){
        $carClasses = CarClass::all();
        $locations= Location::all();

         return view('homePage', compact('carClasses','locations'));
    }

}
