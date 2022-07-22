@extends('layouts.dashboard')

@section('dash-title', __('Streams'))

@section('dash-content')

    <h3>Просмотр стрима #{{ $stream->id }}</h3>
    <h4 class="text-muted">{{ 'Автор: ' . $stream->user->name }}</h4>
    <div class="mb-4">Описание: {{ $stream->description }}</div>

    @can('update', $stream)
        <div class="card mb-4">
            <div class="card-header">Информация для владельца</div>
            <div class="card-body fw-bold">
                <div class="mb-2">Для вещания по протоколу RTMP используйте ссылку: <code>{{ $stream->ant_data_online->rtmpURL }}</code></div>
                <div>Данные для авторизации: <code>{{ $stream->ant_data_online->username }}</code> : <code>{{ $stream->ant_data_online->password }}</code></div>
            </div>
        </div>
    @endcan

    @if ($stream->isOnline())
        <iframe 
            src="{{ $stream->isOnline() ? $stream->player_src : $stream->preview_url_path }}" 
            frameborder="0" 
            class="stream-frame-full"
        ></iframe>
    @else
        <img src="{{ $stream->preview_url_path }}" alt="Preview" width="300">
    @endif

@endsection