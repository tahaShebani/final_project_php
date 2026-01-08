@props(['car'])

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="relative h-48 bg-gray-100">
        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->model_name }}" class="w-full h-full object-contain p-4">
        <span class="absolute top-4 right-4 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
            {{ $car->car_class }}
        </span>
    </div>

    <div class="p-5">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">{{ $car->brand }}</p>
                <h3 class="text-xl font-bold text-gray-900">{{ $car->model_name }} <span class="text-gray-400 font-normal">{{ $car->year }}</span></h3>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-y-3 gap-x-2 mt-4 pb-5 border-b border-gray-50">
            <div class="flex items-center text-gray-600 text-sm">
                <span class="mr-2">⚙️</span> {{ $car->transmission }}
            </div>
            <div class="flex items-center text-gray-600 text-sm">
                <span class="mr-2">⛽</span> {{ $car->fuel_type }}
            </div>
            <div class="flex items-center text-gray-600 text-sm">
                <span class="mr-2">👥</span> {{ $car->seating_capacity }} Seats
            </div>
            <div class="flex items-center text-gray-600 text-sm">
                <span class="mr-2">🚗</span> {{ $car->car_class }}
            </div>
        </div>

        <div class="mt-5">
            <a href="{{ route('car.show',$car->id) }}" class="flex justify-center items-center w-full py-3 px-4 bg-indigo-50 text-indigo-700 font-bold rounded-xl hover:bg-indigo-600 hover:text-white transition-all group">
                View Details
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</div>
