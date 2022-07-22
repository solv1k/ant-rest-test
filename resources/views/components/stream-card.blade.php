<div class="card my-4">
    <div class="card-header">
        {{ $stream->name }} 
        <span class="text-muted">{{ $stream->type }} [{{ $stream->isOnline() ? 'Online' : 'Offline' }}]</span>
    </div>
    <div class="card-body">
        <div class="mb-2">
            {{ $stream->description }}
        </div>
        <img src="{{ $stream->preview_url_path }}" alt="Preview" width="300">
        <div class="mt-2">
            <a class="btn btn-success btn-sm" href="{{ route('stream-show', compact('stream')) }}">Смотреть стрим</a>
        </div>
    </div>
</div>