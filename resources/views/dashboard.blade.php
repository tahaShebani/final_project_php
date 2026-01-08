<x-layouts.main-layout>
    @include('layouts.navigation')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>

<div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900">Welcome back, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-500 mt-2">Manage your luxury vehicle reservations below.</p>
            </div>

            <div class="grid grid-cols-1  md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Bookings</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $reservations->count() }}</p>
                    </div>
                </div>
            </div>


            <div class="bg-white px-6 mt-20 shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h3 class="text-xl font-bold text-slate-900">Active Reservations</h3>
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">Rent Another Car →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-slate-500 text-xs uppercase tracking-wider">
                                <th class="px-8 py-4  font-semibold">Vehicle Details</th>
                                <th class="px-8 py-4  font-semibold">Rental Period</th>
                                <th class="px-8 py-4  font-semibold">Total Amount</th>
                                <th class="px-8 py-4  font-semibold">Status</th>
                                <th class="px-5 py-4  font-semibold">Rent Status</th>
                                <th  colspan="2" class="px-5 py-4  font-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($reservations as $res)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-10 rounded bg-gray-100 overflow-hidden flex-shrink-0">
                                            <img src="{{ asset('storage/' . $res->vehicle->carModel->image_path) }}" class="object-cover w-full h-full" alt="Car">
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900">{{ $res->vehicle->carModel->brand }} {{ $res->vehicle->carModel->full_name }}</div>
                                            <div class="text-xs text-gray-400 capitalize">{{ $res->vehicle->type }} • ID: #{{ $res->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm text-slate-700 font-medium">{{ $res->pickup_date->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400 mt-1">to {{ $res->return_date->format('M d, Y') }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-lg font-bold text-slate-900">${{ number_format($res->total_price, 2) }}</div>
                                </td>
                                <td class="px-5 py-6">
                                    @php
                                        $statusClasses = [
                                            'confirmed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100'
                                        ][$res->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses }}">
                                        {{ ucfirst($res->status) }}
                                    </span>
                                </td>

                                 <td class="px-5 py-6">
                                    @php
                                        if($res->transaction){
                                        $statusClasses = [
                                            'closed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'open' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        ][$res->transaction->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                                        $tranStatus = $res->transaction->status;
                                         }else{
                                            $statusClasses = 'bg-gray-50 text-gray-700 border-gray-100';
                                            $tranStatus = 'Not  Yet';
                                         }
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses }}">


                                        {{ ucfirst($tranStatus) }}
                                    </span>
                                </td>
                                <td class="px-5 py-6 text-right">
                                    <a href="{{ route('reservation.show', $res->id) }}"
                                    class="inline-block bg-slate-900 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-black transition transform active:scale-95 shadow-md">
                                        More
                                    </a>

                                </td>
                                 @php
                                    if($res->status === 'cancelled'||$res->transaction){
                                        $cancel='hidden';
                                    }
                                    else{
                                        $cancel='';
                                    }
                                 @endphp
                                <td class="px-8 py-6 {{ $cancel }} text-right">
                                    <form action="{{ route('reservation.update', $res->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="cancelled">

                                        <button type="submit"
                                                onclick="return confirm('Are you sure you want to cancel this reservation?')"
                                                class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-700 transition transform active:scale-95 shadow-md">
                                            Cancel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-16 text-center">
                                    <div class="max-w-xs mx-auto">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        <p class="mt-4 text-gray-500 font-medium">No reservations found.</p>
                                        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Find a car today</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>
