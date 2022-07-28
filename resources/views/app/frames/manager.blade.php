@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="float-left mb-0">Režģu redaktors</h2>
                @if (count($frames)>0)
                    <ul class="list-inline list-unstyled float-left ml-3">
                        @foreach($frames as $frame)
                            <li class="list-inline-item"><a class="btn btn-link" href="{{ route('frame-manager', ['frame' => $frame->id]) }}">{{$frame->title}}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-12">
                <h3 class="text-center mb-4">{{ $currentFrame->title }}</h3>
                <div class="frame-grid" style="grid-template-columns: repeat({{$currentFrame->cols}}, 100px); grid-template-rows: repeat({{$currentFrame->rows}}, 100px); width:{{$currentFrame->cols*100}}px">
                    @for($i=0; $i<$currentFrame->rows; $i++)
                        @for($j=0; $j<$currentFrame->cols; $j++)
                            <div class="frame-grid-item" title="[{{$i + 1}},{{$j + 1}}]">
                                @include('app.frames._manage_grid_item')
                            </div>
                        @endfor
                    @endfor
                </div>
            </div>
            @include('app.frames._images_modal')
            <input type="hidden" name="frame-id" id="frame-id" value="{{$currentFrame->id}}">
            <input type="hidden" name="frame-row" id="frame-row" value="0">
            <input type="hidden" name="frame-col" id="frame-col" value="0">
        </div>
    </div>
@endsection
