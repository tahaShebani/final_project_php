<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function viewAll(Request $request)
    {
        // 1. Get all locations for the return dropdown
        $locations = Location::all();
        $vehicle = Vehicle::with('carModel','currentLocation')->find($request->vehicle);




        return view('RentPage', compact('vehicle','locations'));
    }
}
