<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    /**
     * تأكيد الحجز
     */
    public function confirm($id): RedirectResponse
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);

        return redirect()->route('reservations.index')->with('success', 'تم تأكيد الحجز');
    }

    /**
     * إلغاء الحجز
     */
    public function cancel($id): RedirectResponse
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('reservations.index')->with('success', 'تم إلغاء الحجز');
    }
}
