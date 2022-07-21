@extends('layouts.dashboard')

@section('dash-title', __('Create New Stream'))

@section('dash-content')
    <h3>Создание нового стрима</h3>
    <form action="{{ route('stream-store') }}" method="POST">
        @csrf
        <input name="name" type="text" class="control form-control mt-4 mb-2" placeholder="Название">
        <textarea name="description" type="text" class="control form-control mb-2" placeholder="Описание"></textarea>
        <input name="preview_url" type="url" class="control form-control mb-4" placeholder="Preview URL">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection