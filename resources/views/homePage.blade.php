
<x-layouts.main-layout>


<div class="max-w-7xl mx-auto py-12 px-4">
    <h2 class="text-2xl font-semibold mb-6">Find The Right Car In The Right Place</h2>

    <x-search-form :locations="$locations" />
</div>
<div class="max-w-7xl mx-auto py-12 px-4">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Browse by Category</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-car-class-card
            title="Sedan"
            image="https://images.unsplash.com/photo-1550355291-bbee04a92027?auto=format&fit=crop&w=400"
            :link="route('cars.index', ['class' => 'sedan'])"
        />

        <x-carClass-card
            title="SUV"
            image="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=400"
            :link="route('cars.index', ['class' => 'suv'])"
        />

        <x-car-class-card
            title="Luxury"
            image="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=400"
            :link="route('cars.index', ['class' => 'luxury'])"
        />

        <x-car-class-card
            title="Electric"
            image="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=400"
            :link="route('cars.index', ['class' => 'electric'])"
        />
    </div>
</div>
</x-layouts.main-layout>

