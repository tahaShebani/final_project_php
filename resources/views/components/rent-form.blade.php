@props(['vehicle', 'locations'])

<div class="max-w-5xl mx-auto my-12 p-8 bg-white shadow-lg rounded-xl border border-gray-100">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-1/3 bg-gray-50 p-6 rounded-lg border border-gray-200">
            <img src="{{ asset('storage/' . $vehicle->carModel->image_path) }}" alt="Car Image" class="w-full rounded-md mb-4 shadow-sm">
            <h3 class="text-xl font-bold text-gray-800 capitalize">{{ $vehicle->carModel->brand }} {{ $vehicle->carModel->full_name }}</h3>
            <p class="text-sm text-gray-500 mb-4">{{ $vehicle->currentLocation->name }}</p>
            <div class="border-t pt-4">
                <span class="text-sm text-gray-600">Price per day:</span>
                <span class="text-xl font-bold text-indigo-600 block">${{ number_format($vehicle->price, 2) }}</span>
            </div>
        </div>

        <div class="md:w-2/3">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Complete Your Reservation</h2>
            {{--  --}}
            <form action="{{ route('reservation.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pickup Date</label>
                        <div class="relative">
                            <input  id="pickup_date" type="date" name="pickup_date" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                min="{{$vehicle->reserved_until->addDay()->format('Y-m-d')??now()->addDay()->format('Y-m-d') }}">
                        </div>
                        @error('return_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Return Date</label>
                        <div class="relative">
                            <input type="date" id="return_date" name="return_date" required disabled
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                placeholder="Select pickup date first">
                        </div>
                        @error('return_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Return Location</label>
                        <select name="return_location_id" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none bg-white transition duration-200">
                            <option value="">Select Drop-off Point</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('return_location_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

<div class="bg-indigo-50 p-4 rounded-lg mt-4">
    <p class="text-lg font-bold text-indigo-900">
         Total Price: $<span id="total_price">0.00</span>
    </p>

    <p class="text-xs text-indigo-700 italic">
        * Duration: <span id="duration">0</span> days
    </p>
    <p class="text-xs text-indigo-700 italic">
        * Based on $<span id="daily_rate">{{ $vehicle->price }}</span> per day
    </p>


</div>
                {{-- <div class="bg-indigo-50 p-4 rounded-lg">
                    <p class="text-sm text-indigo-800 italic">
                        * Total price will be calculated based on the number of days between your pickup date and return date.
                    </p>
                </div> --}}

<div class="md:col-span-2 border-t border-gray-100 pt-6 mt-2">
    <label class="block text-sm font-bold text-gray-800 mb-4">Payment Information</label>

    <div class="space-y-4">

        <div class="relative">
            <input type="text" name="card_number" placeholder="Card Number (0000 0000 0000 0000)"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
            <div class="absolute right-4 top-3.5 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
        </div>
        <div class="w-full px-4 py-3"></div>

        <div class="grid grid-cols-2 gap-4">
            <div class="relative ">
                <input type="text" name="expiry" placeholder="MM / YY"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
            </div>
            <div class="relative">
                <input type="text" name="cvc" placeholder="CVC"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                <div class="absolute right-4 top-3.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

                <button  type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-lg shadow-lg transform transition active:scale-95">
                    Confirm & Reserve Now
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pickupInput = document.getElementById('pickup_date');
        const returnInput = document.getElementById('return_date');
        const displayPrice = document.getElementById('total_price');
        const duration = document.getElementById('duration');
        const dailyRate = parseFloat(document.getElementById('daily_rate').innerText);

        function calculateTotal() {
            const pickupDate = new Date(pickupInput.value);
            const returnDate = new Date(returnInput.value);

            if (pickupInput.value && returnInput.value) {
                // Calculate difference in milliseconds
                const differenceInTime = returnDate.getTime() - pickupDate.getTime();

                // Convert to days
                const differenceInDays = Math.ceil(differenceInTime / (1000 * 3600 * 24));

                if (differenceInDays > 0) {
                    const total = differenceInDays * dailyRate;
                    displayPrice.innerText = total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    duration.innerText=differenceInDays;
                } else {
                    displayPrice.innerText = "0.00";
                }
            }
        }

        pickupInput.addEventListener('change', calculateTotal);
        returnInput.addEventListener('change', calculateTotal);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pickupInput = document.getElementById('pickup_date');
        const returnInput = document.getElementById('return_date');

        pickupInput.addEventListener('change', function() {
            if (this.value) {
                // 1. Enable the return date input
                returnInput.disabled = false;
                returnInput.classList.remove('bg-gray-100'); // Remove the "disabled" gray look

                // 2. Prevent choosing a date before the pickup date
                // We add 1 day to the pickup date for the minimum return date
                let selectedDate = new Date(this.value);
                selectedDate.setDate(selectedDate.getDate() + 1);

                let minReturnDate = selectedDate.toISOString().split('T')[0];
                returnInput.min = minReturnDate;

                // 3. If the current return date is now invalid, clear it
                if (returnInput.value && returnInput.value < minReturnDate) {
                    returnInput.value = '';
                }
            } else {
                returnInput.disabled = true;
                returnInput.value = '';
                returnInput.classList.add('bg-gray-100');
            }
        });
    });
</script>
