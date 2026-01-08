<?php

namespace App\Console\Commands;

use App\Filament\BookingAgent\Resources\Reservations\Schemas\ReservationForm;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Console\Command;

class AutoCancelExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-cancel-expired-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredReservations = Reservation::where('return_date', '<', now())
        ->whereIn('status', ['pending', 'confirmed'])
        ->whereDoesntHave('transaction')
        ->get();
        $count=0;
        foreach ($expiredReservations as $reservation) {
            $count++;
        $vehicle= Vehicle::findOrFail($reservation->vehicle_id);

        $vehicleOtherRes=Reservation::whereDoesntHave('transaction')
        ->whereIn('status',['confirmed','pending'])
        ->where('vehicle_id',$reservation->vehicle_id)
        ->orderBy('pickup_date', 'desc')
        ->first();

        $vehicleSecRes=Reservation::with('transaction')
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
        $reservation->update(['status' => 'cancelled']);

        }
        if($count==0)
        $this->info('no Expired reservations found.');
        else
        $this->info($count.'Expired reservations  processed successfully.');

    }
}
