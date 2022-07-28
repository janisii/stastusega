<?php
$image = \App\Cell::getCellImage($currentFrame->id, $i, $j);
?>

@if($image)
    <div class="frame-grid-item-image d-flex align-items-center justify-content-center">
        <img class="position-absolute" src="/i/{{$image->filename}}?w=100&h=100&fit=crop" alt="{{$image->filename_ori}}" title="{{$image->filename_ori}}">
        <button class="position-absolute btn btn-sm btn-danger btn-frame-image-remove" data-action="{{route('frame-image-remove')}}" data-row="{{$i}}" data-col="{{$j}}" data-image="{{$image->id}}" data-frame="{{$currentFrame->id}}">&times;</button>
    </div>
@else
    <button data-toggle="modal" data-target="#frames-image-list" title="[{{$i + 1}},{{$j + 1}}]" data-row="{{$i}}" data-col="{{$j}}" class="btn btn-warning btn-sm btn-frames-image-coords">&plus;</button>
@endif
