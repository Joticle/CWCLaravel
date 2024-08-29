<div class="container my-5">
    @if ($contentType == 'paragraph')
        <p>{{ $courseContent->value }}</p>
    @else
        <iframe id="videoFrame" height="400px" class="embed-responsive-item" src="{{ trim($courseContent->value) }}"
            allowfullscreen></iframe>
    @endif
</div>
