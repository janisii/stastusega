@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('app.images.form-upload')

                @if (count($images)>0)
                    <h2 class="mt-4 mb-4">Fragmentu bildes <a href="{{ route('images-apply') }}" title="Jauns" class="btn btn-link">Bilžu piesaiste fragmentiem</a> <a href="{{ route('generate-stories') }}" title="" class="btn btn-link">Ģenerēt stāstu fragmentus bildēm bez stāsta</a></h2>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width:110px">Bilde</th>
                                <th>Nosaukums</th>
                                <th>Fails</th>
                                <th>Stāsts</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $image)
                            <tr>
                                <td>{{$image->id}}</td>
                                <td style="background-color: {{$image->background_hex}}"><img src="/i/{{$image->filename}}?w=100&h=100&fit=crop" alt="{{$image->filename_ori}}" title="{{$image->filename_ori}}"></td>
                                <td>{{ getNameFromFileName($image->filename_ori) }}</td>
                                <td>{{ $image->filename }}</td>
                                <td>
                                    @if ($image->fragment)
                                        <a href="{{ route('fragments-edit', ['fragment' => $image->fragment->id]) }}" title="">{{ $image->fragment->name }} {{ $image->fragment->course }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection