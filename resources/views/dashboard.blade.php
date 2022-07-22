@extends('layouts.dashboard')

@section('dash-title', __('Dashboard'))

@section('dash-content')
    <div class="mb-2 text-center">
        <a class="btn btn-primary" href="{{ route('stream-create-form') }}">Добавить стрим</a>
    </div>
    <h3>Список стримов</h3>
    <div class="d-flex flex-wrap gap-4">
        @forelse ($streams as $stream)
            @include('components.stream-card', compact('stream'))
        @empty
            <div class="alert alert-info">Стримы не найдены...</div>
        @endforelse
    </div>
    {{ $streams->links() }}
@endsection
