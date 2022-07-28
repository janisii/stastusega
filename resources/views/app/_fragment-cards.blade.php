@if (count($items) > 0)
    <div class="card-columns">
    @foreach( $items as $item)
            <div class="card" style="display: inline-block">
                @if($item->image_id)
                <img class="card-img-top" src="/i/{{$item->image_filename}}?w=200&h=200&fit=crop" alt="{{$item->image_filename_ori}}" title="{{$item->image_filename_ori}}">
                <div class="card-body">
                    <h5 class="card-title mb-0">{{ $item->image_filename_ori }}</h5>
                    <p class="card-text mt-2">Stāsts nav pieejams!</p>
                </div>
                @endif
                @if($item->fragment_id)
                <div class="card-body">
                    <h5 class="card-title mb-0"><a href="{{route('fragments-edit', ['fragment' => $item->fragment_id])}}">{{ $item->fragment_name }}</a></h5>
                    <p class="card-course mt-1 mb-0">{{ $item->fragment_course }}</p>
                    <p class="card-text mt-2">{!! nl2br(e(mb_substr($item->fragment_story, 0, 100))) !!} ... </p>
                </div>
                @endif
            </div>
    @endforeach
    </div>
@endif