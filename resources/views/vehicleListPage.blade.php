

<x-layouts.main-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">

            <aside class="w-full md:w-1/4 lg:w-1/5">
                <x-sidebar  :pickup-date="$pickup_date" :pickup-location="$pickup_location" :brands="$brands"></x-sidebar>
            </aside>

            <main class="flex-1">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


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
            </main>

            </div>
    </div>
</x-layouts.main-layout>
