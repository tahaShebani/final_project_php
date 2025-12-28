
{{-- @foreach ($carClasses as $carclass)
    <h3>{{ $carclass->class }}</h3>
    <img src="{{ asset('storage/' . $carclass->image_path) }}" alt="{{ $carclass->class }}">
    <a href="\models\{{ $carclass->id }}">See More</a>

@endforeach --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
</head>
<body>
<div class="bg-gray-50 min-h-screen py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Our Fleet</h1>
        <p class="text-gray-600 mb-10">Select a category to explore our premium vehicles.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($carClasses as $class)
                <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <img src="{{ asset('storage/' . $class->image_path) }}" alt="Car Image" style="width:200px;">
                            {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg> --}}
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $class->class }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $class->car_models_count ?? $class->carModels->count() }} Models Available</p>

                        <a href="\models\{{ $class->id }}" class="mt-6 inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                            Browse Collection
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>



