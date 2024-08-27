@foreach ($tags as $index => $tag)
    <div class="single-checkbox-filter">
        <div class="check-box">
            <input type="checkbox" id="tag-{{ $index }}">
            <label for="tag-{{ $index }}">{{ ucFirst($tag) }}</label><br>
        </div>
    </div>
@endforeach
