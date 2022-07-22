@extends('layouts.dashboard')

@section('dash-title', __('Streams'))

@section('dash-content')
    <h3>Создание нового стрима</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('stream-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="name" type="text" class="control form-control mt-4 mb-2" placeholder="Название">
        <textarea name="description" type="text" class="control form-control mb-2" placeholder="Описание"></textarea>
        <div class="form-group">
            <label for="preview">Превью (изображение в формате png или jpg, максимальнй размер 4мб, минимальная ширина 400, минимальная высота 200)</label>
            <input id="preview" name="preview" type="file" class="control form-control mb-4" accept=".jpg,.png">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection