<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
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


        $pickup_date=$request->pickup_date;
        $pickup_location=$request->pickup_location;
        $brands=CarModel::select('brand')->distinct()->get();
        return view('vehicleListPage', compact('vehicles','pickup_date','pickup_location','brands'));
    }


        public function viewAllFilter(Request $request)
    {

        $query = Vehicle::query()->with('carModel','currentLocation');

        if(($request->pickup_location==null)||($request->pickup_date==null)){
             return redirect('home');
        }


        if ($request->has('pickup_location') ) {
        $query->availableVechiles($request->pickup_location,$request->pickup_date);
        if($request->has('classes')){
            $selectedClasses = $request->input('classes', []);
           $query->classes($selectedClasses);
        }

        if($request->has('model'))
        $query->modeles($request->model);

        if($request->has('min_price')||$request->has('max_price'))
        $query->price($request->min_price,$request->max_price);

        if($request->has('min_year')||$request->has('max_year'))
        $query->year($request->min_year,$request->max_year);

        if($request->has('color'))
        $query->color($request->color);

        $vehicles = $query->get();
        }else{
           $vehicles=Vehicle::query()->get();
        }


        $pickup_date=$request->pickup_date;
        $pickup_location=$request->pickup_location;
        $brands=CarModel::select('brand')->distinct()->get();
        return view('vehicleListPage', compact('vehicles','pickup_date','pickup_location','brands'));
    }
}
