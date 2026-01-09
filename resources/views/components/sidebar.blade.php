@props(['pickup_date' => request('pickup_date'),
    'pickup_location' => request('pickup_location')])

<aside class="w-full md:w-64 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <form action="{{ route('searchFilter') }}" method="GET" >
        <input type="text" value="{{ $pickup_location }}" name="pickup_location" id="pickup_location" class="hidden">
        <input type="date" value="{{ $pickup_date }}" name="pickup_date" id="pickup_date" class="hidden">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Filter Vehicles</h2>

    <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Car Brand</label>
        <select  name="model" class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <option >All Brands</option>
            <option value="toyota">Toyota</option>
            <option value="honda">Honda</option>
            <option value="bmw">BMW</option>
        </select>
    </div>

    <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Vehicle Class</label>
        <div class="space-y-2">
            <label class="flex items-center text-gray-600 text-sm">
                <input  type="checkbox" name="classes[]" value="suv" class="rounded text-blue-600 mr-2"> SUV
            </label>
            <label class="flex items-center text-gray-600 text-sm">
                <input type="checkbox" name="classes[]" value="sedan" class="rounded text-blue-600 mr-2"> Sedan
            </label>
            <label class="flex items-center text-gray-600 text-sm">
                <input type="checkbox"  name="classes[]" value="luxury" class="rounded text-blue-600 mr-2"> Luxury
            </label>
            <label class="flex items-center text-gray-600 text-sm">
                <input type="checkbox"  name="classes[]" value="electric" class="rounded text-blue-600 mr-2"> Electric
            </label>
        </div>
    </div>

<div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Price Range ($)</label>
    <div class="flex items-center gap-2">
        <div class="relative flex-1">
            <input type="number"
                   name="min_price"
                   placeholder="Min"

                   class="w-full pl-7 pr-2 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
        </div>

        <span class="text-gray-400">—</span>

        <div class="relative flex-1">
            <input type="number"
                   name="max_price"
                   placeholder="Max"

                   class="w-full pl-7 pr-2 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
        </div>
    </div>
</div>

<div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Year</label>
    <div class="flex items-center gap-2">
        <div class="relative flex-1">
            <input type="number"
                   name="min_year"
                   placeholder="Min"
                   class="w-full pl-7 pr-2 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
        </div>

        <span class="text-gray-400">—</span>

        <div class="relative flex-1">
            <input type="number"
                   name="max_year"
                   placeholder="Max"
                   class="w-full pl-7 pr-2 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
        </div>
    </div>
</div>

<div class="mb-8">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Color</label>
    <div class="flex gap-3">
        @php
            // Define your colors: 'value' => 'tailwind_class'
            $colors = [
                'red' => 'bg-red-600',
                'black' => 'bg-gray-900',
                'white' => 'bg-white border-gray-300',
                'blue' => 'bg-blue-600',
                'grey' => 'bg-gray-500'
            ];
        @endphp

        @foreach($colors as $name => $class)
            <label class="relative cursor-pointer">
                <input type="radio" name="color" value="{{ $name }}" class="peer sr-only"
                    {{ request('color') == $name ? 'checked' : '' }}>

                <span class="block w-8 h-8 rounded-full {{ $class }} border-2 border-transparent
                    peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-indigo-500
                    peer-checked:border-white transition-all shadow-sm hover:scale-110">
                </span>
            </label>
        @endforeach
    </div>
</div>

    <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-lg font-semibold hover:bg-black transition">
        Apply Filters
    </button>
</form >
</aside>
