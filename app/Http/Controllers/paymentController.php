<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::whereRelation('reservation', 'customer_id', Auth::user()->id)->get();
        $totalSpent = Payment::whereRelation('reservation', 'customer_id', Auth::user()->id)->sum('amount');

        return  view('Payments',compact('payments','totalSpent'));
    }


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Payment $payment)
    {
        if(true){
            $payment->status='paid';
            $payment->save();
        }

        return redirect('payments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
