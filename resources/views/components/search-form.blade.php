@props(['locations' => []])

<form action="{{ route('search') }}" method="GET" class="bg-white p-6 shadow-md rounded-lg border border-gray-100">
    <div class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="pickup_location" value="Pickup Location" />
                <select required name="pickup_location" id="pickup_location" class="w-full mt-1 px-4 py-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Select Pickup City</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
            <x-input-label for="pickup_date" value="Pickup Date" />
            <input required type="date" name="pickup_date" id="pickup_date" min="{{ now()->format('Y-m-d') }}" class="w-full mt-1 px-4 py-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>
        </div>



        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 text-lg font-bold">
                {{ __('Search Available Cars') }}
            </x-primary-button>
        </div>
    </div>
</form>
