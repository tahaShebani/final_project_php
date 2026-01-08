<x-layouts.main-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($vehicles as $vehicle)
        <x-vehicle-card :vehicle="$vehicle" />
    @endforeach

    @forelse ($vehicles as $vehicle)
         <x-vehicle-card :vehicle="$vehicle" />
    @empty
        <div class="no-vehicles flex flex-col items-center justify-center min-h-[200px] text-center">
        <p>No cars available.
            <a href="{{ route('home') }}" class="underline text-blue-500">
                Click here to go back home.
            </a>
        </p>
    </div>
    @endforelse
</div>
</x-layouts.main-layout>
