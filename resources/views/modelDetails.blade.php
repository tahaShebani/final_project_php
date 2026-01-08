<x-layouts.main-layout>
    <div class="max-w-7xl mx-auto py-12 px-4">
                        <a href="{{ route('cars.index',['class' => $carmodel->carClass->class]) }}" class="group flex items-center text-xs font-bold tracking-widest uppercase text-slate-400 hover:text-slate-900 transition">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back
                </a>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>
                <img src="{{ asset('storage/' . $carmodel->image_path) }}" class="w-full rounded-2xl shadow-lg" alt="{{ $carmodel->full_name }}">
            </div>

            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-gray-900">{{ $carmodel->make }} {{ $carmodel->model_name }}</h1>
                {{-- <p class="text-2xl text-blue-600 font-semibold">${{ number_format($vehicle->price, 2) }}</p> --}}

                <div class="grid grid-cols-2 gap-4 border-t pt-4">
                    <div>
                        <span class="text-gray-500 block">Year</span>
                        <span class="font-bold">{{ $carmodel->year }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block">Fuel Type</span>
                        <span class="font-bold">{{ $carmodel->fuel_type }}</span>
                    </div>
                </div>

                {{-- <p class="text-gray-600 pt-4">
                    {{ $vehicle->description }}
                </p> --}}

                {{-- <button @click="showPayModal = true" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold shadow-lg hover:bg-blue-700">
                    Book This Car Now
                </button> --}}
            </div>
        </div>
    </div>
</x-layouts.main-layout>
