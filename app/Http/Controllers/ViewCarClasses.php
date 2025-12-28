<?php

namespace App\Http\Controllers;

use App\Models\CarClass;
use Illuminate\Http\Request;

class ViewCarClasses extends Controller
{
    public function viewAll(){
        $carClasses = CarClass::all();

         return view('homePage', compact('carClasses'));
    }

}
