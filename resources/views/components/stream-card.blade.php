<div class="card my-4">
    <div class="card-header">
        {{ $stream->name }}

        <span class="text-muted">{{ '@' . $stream->user->name }}</span>

        @if ($stream->isOnline())
            <span class="badge bg-success">Online</span>
        @else
            <span class="badge bg-secondary">Offline</span>
        @endif
    </div>
    <div class="card-body">
        <div class="card-description mb-2">
            {{ $stream->description }}
        </div>
        <img src="{{ $stream->preview_url_path }}" alt="Preview" width="300">
        <div class="mt-2">
            <a class="btn btn-success btn-sm" href="{{ route('stream-show', compact('stream')) }}">Смотреть стрим</a>
        </div>
    </div>
</div>