@props(['vehicle'])

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
    <div class="relative h-44 bg-gray-50">
        <img src="{{ asset('storage/' . $vehicle->carModel->image_path) }}"
             alt="{{ $vehicle->carModel->model_name }}"
             class="w-full h-full object-contain p-4">

        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur px-2 py-1 rounded-lg border border-gray-200 shadow-sm">
            <span class="w-3 h-3 rounded-full mr-2 border border-gray-300" style="background-color: {{ $vehicle->color }};"></span>
            <span class="text-xs font-medium text-gray-700 capitalize">{{ $vehicle->color }}</span>
        </div>
    </div>

    <div class="p-5">
        <div class="flex justify-between items-start mb-3">
            <div>
                <h3 class="text-lg font-bold text-gray-900 leading-tight">
                    {{ $vehicle->carModel->brand }} {{ $vehicle->carModel->full_name }}
                </h3>
                <p class="text-sm text-gray-500 mt-1 flex items-center">
                    📍 {{ $vehicle->currentLocation->name ?? 'Available Now' }}
                </p>
            </div>
        </div>

        <div class="flex items-center justify-between py-3 border-y border-gray-50 my-4 text-sm text-gray-600">
            <div class="flex flex-col">
                <span class="text-gray-400 text-xs uppercase">Mileage</span>
                <span class="font-semibold">{{ number_format($vehicle->mileage) }} km</span>
            </div>
            <div class="flex flex-col text-right">
                <span class="text-gray-400 text-xs uppercase">Price / Day</span>
                <span class="font-bold text-indigo-600 text-base">${{ number_format($vehicle->price, 2) }}</span>
            </div>
        </div>
{{-- {{ route('rent.checkout', $vehicle->id) }} --}}
        <a href="{{ route('rent.checkout', $vehicle->id) }}"
           class="block w-full text-center py-3 px-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-indigo-600 transition-colors">
            Rent This Car
        </a>
    </div>
</div>
