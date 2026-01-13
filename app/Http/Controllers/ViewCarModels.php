<?php

namespace App\Http\Controllers;

use App\Models\CarClass;
use App\Models\CarModel;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class ViewCarModels extends Controller
{
public function viewAll(Request $request)
    {

        $query = CarClass::query()->with('carModels');

        if ($request->has('class')) {
            $query->where('class', $request->class);
        $class = $query->get();
        if(!($class->isEmpty())){
          $cars= $class[0]->carModels;
        }else{
            $cars=CarModel::query()->get();
        }

        }else{
            $cars=CarModel::query()->get();
        }




        return view('carModelsPage', compact('cars'));
    }
    public function show(CarModel $carmodel){

        return view('modelDetails',compact('carmodel'));
    }
}
