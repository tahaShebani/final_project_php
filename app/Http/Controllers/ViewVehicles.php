<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class ViewVehicles extends Controller
{
    public function viewAll(Request $request)
    {

        $query = Vehicle::query()->with('carModel','currentLocation');

        if(($request->pickup_location==null)||($request->pickup_date==null)){
             return redirect('home');
        }
           

        if ($request->has('pickup_location') ) {
        $query->availableVechiles($request->pickup_location,$request->pickup_date);
        $vehicles = $query->get();
        }else{
           $vehicles=Vehicle::query()->get();
        }




        return view('vehicleListPage', compact('vehicles'));
    }
}
