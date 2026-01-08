<x-layouts.main-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 px-4">
                {{ request('class') ? ucfirst(request('class')) . ' Models' : 'All Car Models' }}
            </h2>

            @if($cars->isEmpty())
                <div class="bg-white p-8 rounded-lg text-center shadow">
                    <p class="text-gray-500">No cars found in this category.</p>
                    <a href="{{ route('cars.index') }}" class="text-indigo-600 hover:underline">View all cars</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                    @foreach($cars as $car)
                        <x-car-card :car="$car" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-layouts.main-layout>
