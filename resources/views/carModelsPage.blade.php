{{-- <h1>Viewing Category: {{ $carClass->class }}</h1> --}}

<div class="model-grid">
    @foreach ($carModels as $model)
        <div class="card">
            <img src="{{ $model->image_path }}"
     alt="{{ $model->model_name }}"
     style="width: 200px; height: 200px; object-fit: cover; border: 1px solid red;">
            <h3>{{ $model->brand }} {{ $model->model_name }} </h3>
            <p>Year: {{ $model->year }}</p>
        </div>
    @endforeach
</div>
