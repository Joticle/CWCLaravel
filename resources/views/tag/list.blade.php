@foreach ($tags as $index => $tag)
    <div class="single-checkbox-filter">
        <div class="check-box">
            <input name="tag" value="{{$tag}}" type="checkbox" id="tag-{{ $index }}">
            <label for="tag-{{ $index }}">{{ ucFirst($tag) }}</label><br>
        </div>
    </div>
@endforeach
