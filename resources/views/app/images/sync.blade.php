@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3">Sinhronizēšana</h2>
                @if (count($images)>0)
                    <form action="{{ route('sync-image-fragment') }}" method="post" id="sync-image-fragment">
                        @csrf
                        <table class="table-bordered table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width:70px;">ID</th>
                                    <th style="width:110px;">Attēls</th>
                                    <th>Faila vārds</th>
                                    <th>Autors</th>
                                    <th>Līdzība %</th>
                                    <th>Apstiprināt</th>
                                    <th>?</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr id="sync-fragment-row-{{$image->fragment->id}}">
                                    <td>{{$image->id}}</td>
                                    <td style="background-color: {{$image->background_hex}}"><img src="/i/{{$image->filename}}?w=100&h=100&fit=crop" alt="" alt="{{$image->filename_ori}}" title="{{$image->filename_ori}}"></td>
                                    <td title="{{$image->filename_ori}}">{{ getNameFromFileName($image->filename_ori) }}</td>
                                    <td>{{$image->fragment->name}} {{$image->fragment->course}}</td>
                                    <td>
                                        <?php
                                            $fragmentAuthor = replaceLVChars(str_replace(',',  '', $image->fragment->name) . ' ' . str_replace('.', '', $image->fragment->course));
                                            similar_text(getNameFromFileName($image->filename_ori), $fragmentAuthor, $perc);
                                        ?>
                                        {{ round($perc, 2) }}
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" id="sync-fragment-input-{{ $image->fragment->id }}" name="sync" value="{{ $image->fragment->id }}" class="form-check-input sync-fragment-input">
                                            <label class="form-check-label" id="sync-fragment-label-{{ $image->fragment->id }}" for="sync-fragment-input-{{ $image->fragment->id }}">...</label>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection