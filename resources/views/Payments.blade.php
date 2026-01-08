<x-layouts.main-layout>
    @include('layouts.navigation')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>
<div class="min-h-screen bg-slate-50 p-8 font-sans">
    <header class="mb-10">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Payment History</h1>
        <p class="text-slate-500 text-lg">Track your luxury vehicle transactions and invoices.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total Spent</p>
            <p class="text-3xl font-black text-slate-900 mt-1">${{ number_format($totalSpent, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Active Deposits</p>
            <p class="text-3xl font-black text-indigo-600 mt-1">1</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-y border-slate-100">
                <tr>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase">Method & Source</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase">Reservation ID</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase">Amount</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase">Date</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase text-center">Status</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($payments as $payment)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-slate-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ strtoupper($payment->payment_method) }}</p>
                                <p class="text-slate-400 text-xs">{{ $payment->payment_source }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-medium">#{{ $payment->reservations_id }}</td>
                    <td class="px-8 py-6 font-black text-slate-900 text-lg">${{ number_format($payment->amount, 2) }}</td>
                    <td class="px-8 py-6 text-slate-400 text-sm">
                        {{ $payment->paied_at ? \Carbon\Carbon::parse($payment->paied_at)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-8 py-6 text-center">
                        @php
                            $colorMap = [
                                'paid' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                'refunded' => 'bg-red-50 text-red-600 border-red-100',
                                'unpaid' => 'bg-orange-50 text-orange-600 border-orange-100',
                            ];
                            $style = $colorMap[$payment->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                        @endphp
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold border {{ $style }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
 @php
                                    if($payment->status !== 'unpaid'){
                                        $cancel='hidden';
                                    }
                                    else{
                                        $cancel='';
                                    }
                                 @endphp
                                <td class="px-8 py-6 {{ $cancel }} text-center">
<div x-data="{ showPayModal: false }">
    <button @click="showPayModal = true" class="bg-green-600 text-white px-6 py-2 rounded">
        Pay Now
    </button>

    <div x-show="showPayModal"
         class="fixed inset-0 {{ $cancel }} z-50 flex items-center justify-center bg-black bg-opacity-50"
         x-cloak>

        <div @click.away="showPayModal = false" class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full">
            <h2 class="text-xl font-bold mb-4">Complete Payment</h2>

            <form action="{{ route('payments.update',$payment->id) }}" method="POST">
                @csrf
                @method('Patch')
                <div class="mb-4">
                    <label class="block text-sm font-medium">Card Details</label>
                    <input type="text" name="card_number" class="w-full border p-2 rounded" required placeholder="1234 5678 ..." maxlength="19" {{-- 16 digits + 3 spaces --}}
           oninput="this.value = this.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim()">
                </div>
                <div class="flex gap-4  justify-center mb-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Expire Date</label>
                    <input type="text" name="expire_date" class="w-1\2 border p-2 rounded" required placeholder="MM\YY" maxlength="5"
               oninput="this.value = this.value.replace(/[^\d]/g, '').replace(/^(\d{2})/, '$1/').replace(/\/$/, '')">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">CSV</label>
                    <input type="text" name="csv" class="w-24 border p-2 rounded" required maxlength="3" placeholder="666" oninput="this.value = this.value.replace(/[^\d]/g, '')">
                </div>
                </div>
                <div class="flex justify-between gap-2">
                    <button type="button" @click="showPayModal = false" class="text-gray-500">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layouts.main-layout>
