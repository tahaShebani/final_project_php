<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation as ReservationModel;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Reservation extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations= ReservationModel::with('vehicle.carModel.carClass','customer','transaction')->where('customer_id',Auth::user()->id)->get();

        return view('dashboard',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        if( $vehicle->reserved_until<$request->pickup_date){

            $pickupDate = Carbon::parse($request->pickup_date);
            $returnDate = Carbon::parse($request->return_date);
            $dailyRate = $vehicle->price;
            $days = $pickupDate->diffInDays($returnDate);
            if ($days <= 0) { $days = 1; }
            $totalPrice = $days * $dailyRate;

            $reservation= ReservationModel::create([
                'customer_id'=>Auth::user()->id,
                'vehicle_id' =>$vehicle->id,
                'pickup_location_id'=>$vehicle->current_location_id,
                'dropoff_location_id'=>$request->return_location_id,
                'reserved_at'=>now(),
                'expires_at'=>now()->addMinutes(30),
                'pickup_date'=>$request->pickup_date,
                'return_date'=>$request->return_date,
                'status'=>'pending',
                'total_price'=>$totalPrice,
            ]);

            $payemnt = Payment::create([
            'reservations_id'  => $reservation->id ??0,
            'amount'           => $reservation->total_price ??0,
            'payment_method'   => 'card', // Taken directly from the form
            'payment_source'   => 'online',
            'processed_by'     => null,
            'transaction_id'   =>  null,
            'paied_at'         => now(),
             ]);
            if ($vehicle) {
                if($vehicle->status=="available")
                    $status='reserved';
                else{
                    $status=$vehicle->status;
                }
          $vehicle->update([
                'status' => $status,
                'reserved_until' => $request->return_date,
                'returned_at_id'=>$request->return_location_id
            ]);
        }
             //هنا تحط المنطق متع التحقق من عملية الدفع كان ناجح او لا
             if(true){
             $payemnt->update([
                'status'=>'paid'
             ]);
             }

        }
        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReservationModel $reservation)
    {
        $reservation->load(['vehicle.carModel.carClass', 'pickupLocation', 'dropoffLocation']);
         return view('ReservationDetails', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationModel $reservation)
    {
        $vehicle= Vehicle::findOrFail($reservation->vehicle_id);

        $vehicleOtherRes=ReservationModel::whereDoesntHave('transaction')
        ->whereIn('status',['confirmed','pending'])
        ->where('vehicle_id',$reservation->vehicle_id)
        ->orderBy('pickup_date', 'desc')
        ->first();

        $vehicleSecRes=ReservationModel::with('transaction')
        ->whereIn('status',['confirmed','pending'])
        ->where('vehicle_id',$reservation->vehicle_id)
        ->orderBy('pickup_date', 'desc')
        ->skip(1)
        ->take(1)
        ->first();

        if($vehicleOtherRes->id==$reservation->id){
            if($vehicleSecRes&&$vehicleSecRes->transaction&&$vehicleSecRes->transaction->status!=='closed'){
                $vehicle->reserved_until=$vehicleSecRes->return_date;
                $vehicle->returned_at_id=$vehicleSecRes->dropoff_location_id;
            }else{
                $vehicle->reserved_until=null;
                $vehicle->returned_at_id=$reservation->pickup_location_id;
                $vehicle->status='available';
            }
            $vehicle->save();

        }
        $reservation->status='cancelled';
         $reservation->save();
        $payments=Payment::where('reservations_id',$reservation->id)->get();

        foreach( $payments as  $payment){
            //تكتب المنطق الخاص باعادة الاموال
            if(true){
                $payment->status='refunded';
                $payment->save();
            }
        }
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
