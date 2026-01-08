@props(['brand' => 'MyLogo', 'links' => []])

<nav class="flex items-center justify-between p-4 bg-gray-800 text-white">
    <div class="text-xl font-bold">
        <a href="/">{{ $brand }}</a>
    </div>

    <div class="space-x-4">
        @foreach($links as $label => $url)
            <a href="{{ $url }}" class="hover:text-gray-400 transition">
                {{ $label }}
            </a>
        @endforeach

        {{ $slot }}
    </div>
</nav>
