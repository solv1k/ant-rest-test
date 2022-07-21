@extends('layouts.dashboard')

@section('dash-title', __('Dashboard'))

@section('dash-debug')
    @php
        print_r($debug)
    @endphp
@endsection

@section('dash-content')
    <h3>Список стримов</h3>
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary" href="{{ route('stream-create-form') }}">Добавить стрим</a>
    </div>
    @forelse ($streams as $stream)
        @include('components.stream-card', compact('stream'))
    @empty
        <div class="alert alert-info">Стримы не найдены...</div>
    @endforelse
@endsection
