@props(['image', 'title', 'link'])

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-transform hover:scale-105 hover:shadow-lg">
    <div class="h-48 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
    </div>

    <div class="p-5 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $title }}</h3>

        <a href="{{ $link }}" class="inline-block w-full py-2 px-4 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-700 transition-colors">
            See More
        </a>
    </div>
</div>
