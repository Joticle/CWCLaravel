@php
    $start = ($data->currentPage() - 1) * $data->perPage() + 1;
    $end = min($start + $data->perPage() - 1, $data->total());
@endphp
<span>Showing {{ $start }}-{{ $end }} of {{ $data->total() }} results</span>