<x-layouts.main-layout>
    @include('layouts.navigation')

    <div class="py-16   bg-white min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            <div class="flex items-center justify-between mb-12">
                <a href="{{ route('dashboard') }}" class="group flex items-center text-xs font-bold tracking-widest uppercase text-slate-400 hover:text-slate-900 transition">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back
                </a>
                <div class="flex items-center mt-2 space-x-3">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] px-2 text-slate-400">Status</span>
                    <span class="text-xs font-bold px-3 py-1 rounded-full border {{ $reservation->status === 'confirmed' ? 'border-emerald-500 text-emerald-600' : 'border-amber-500 text-amber-600' }}">
                        {{ $reservation->status }}
                    </span>
                </div>
            </div>

            <div class="text-center mb-16">
                <h1 class="text-5xl font-black text-slate-900 tracking-tight mb-4">
                    {{ $reservation->vehicle->carModel->brand }} <span class="text-slate-400">{{ $reservation->vehicle->carModel->full_name }}</span>
                </h1>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-[0.3em]">Reservation #{{ $reservation->id }}</p>

                <div class="mt-10 relative">
                    <img src="{{ asset('storage/' . ($reservation->vehicle->carModel->image_path?? 'default-car.png')) }}" class="w-full max-w-2xl mx-auto object-contain" alt="Car">
                    <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent h-full w-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 border-t border-gray-100 pt-16">

                <div class="space-y-12">
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 mb-6">Schedule</h4>
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="text-xs text-slate-400 mb-1 font-bold">Pick-up</p>
                                <p class="text-base font-bold text-slate-900">{{ $reservation->pickup_date->format('M d, Y') }}</p>
                                <p class="text-sm text-slate-500 mt-1">{{ $reservation->pickupLocation->name ?? 'Main Hub' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-1 font-bold">Return</p>
                                <p class="text-base font-bold text-slate-900">{{ $reservation->return_date->format('M d, Y') }}</p>
                                <p class="text-sm text-slate-500 mt-1">{{ $reservation->dropoffLocation->name ?? 'Main Hub' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 my-3">Vehicle Specs</h4>
                        <ul class="space-y-3">
                            <li class="flex justify-between text-sm border-b border-gray-50 px-5 py-2">
                                <span class="text-slate-400">Class</span>
                                <span class="font-bold text-slate-900 capitalize">{{ $reservation->vehicle->carModel->carClass->class }}</span>
                            </li>
                            <li class="flex justify-between text-sm border-b border-gray-50 px-5 py-2">
                                <span class="text-slate-400">Identification</span>
                                <span class="font-bold text-slate-900">{{ $reservation->vehicle->vin }}</span>
                            </li>
                                <li class="flex justify-between text-sm border-b border-gray-50 px-5 py-2">
                                <span class="text-slate-400">Fual Type</span>
                                <span class="font-bold text-slate-900">{{ $reservation->vehicle->carModel->fuel_type }}</span>
                            </li>

                            </li>
                                <li class="flex justify-between text-sm border-b border-gray-50 px-5 py-2">
                                <span class="text-slate-400">Number Of Doors</span>
                                <span class="font-bold text-slate-900">{{ $reservation->vehicle->carModel->seating_capacity }}</span>
                            </li>

                            </li>
                                <li class="flex justify-between text-sm border-b border-gray-50 px-5 py-2">
                                <span class="text-slate-400">Transmission</span>
                                <span class="font-bold text-slate-900">{{ $reservation->vehicle->carModel->transmission }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-3xl p-10 flex flex-col justify-between">
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-900 mb-8">Statement</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-500 font-medium">Daily Rate</span>
                                <span class="text-sm font-bold text-slate-900">${{ number_format($reservation->vehicle->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-500 font-medium">Days Total</span>
                                <span class="text-sm font-bold text-slate-900">{{ number_format($reservation->pickup_date->diffInDays($reservation->return_date),0) ?: 1 }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-200 flex justify-between items-center">
                                <span class="text-base font-black text-slate-900">Total</span>
                                <span class="text-2xl font-black text-slate-900">${{ number_format($reservation->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 space-y-3">
                        <button class="w-full bg-slate-900 text-white py-4 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition shadow-lg active:scale-95">
                            Download PDF
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-20 text-center">
                <p class="text-xs text-slate-400 font-medium">Need to modify your booking? <a href="#" class="text-indigo-600 font-bold hover:underline">Contact Concierge</a></p>
            </div>
        </div>
    </div>
</x-layouts.main-layout>
