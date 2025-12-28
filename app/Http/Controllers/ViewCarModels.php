<?php

namespace App\Http\Controllers;

use App\Models\CarClass;
use Illuminate\Http\Request;

class ViewCarModels extends Controller
{
        public function viewAll($id){
        $carClass = CarClass::with('carModels')->findOrFail($id);
        $carModels = $carClass->carModels;

         return view('carModelsPage', compact('carModels'));
    }
}
