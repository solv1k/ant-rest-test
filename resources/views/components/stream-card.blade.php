<div class="card my-4">
    <div class="card-header">
        {{ $stream->name }} 
        <span class="text-muted">{{ $stream->ant_json['type'] }} [{{ $stream->ant_json['status'] }}]</span>
    </div>
    <div class="card-body">
        <iframe 
            src="http://185.209.160.70:5080/StreamingApp/play.html?name={{ $stream->streamId }}&autoplay=true" 
            frameborder="0" 
            class="stream-frame"
        ></iframe>
    </div>
</div>