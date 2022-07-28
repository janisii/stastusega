@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-sm-12">

                <div class="pt-3">
                    @if (!$item->id)
                        <h3>Jauna fragmenta reģistrēšana</h3>
                    @endif
                    @if ($item->id > 0)
                        <h3>Fragmenta rediģēšana</h3>
                    @endif
                </div>

                @if (!$item->id)
                <form action="{{ route($submitRoute) }}" method="post" enctype="multipart/form-data" class="py-3">
                @endif

                @if ($item->id>0)
                    <form action="{{ route($submitRoute, ['fragment' => $item->id]) }}" method="post" enctype="multipart/form-data" class="py-3">
                @endif

                    @csrf
                    @if ($item->id>0)
                        @method('PUT')
                    @endif
                    <input type="hidden" id="id" name="id" value="{{$item->id ? $item->id : 0}}" />

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Autors</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Ievadiet vārdu uzvārdu" required="required" value="{{ $item->name ? $item->name : old('name') }}" />
                        </div>
                        @if (Auth::user()->group === 'admin')
                        <div class="col-sm-2 align-self-center">
                            <div class="form-check">
                                <input type="checkbox" id="anonymous" name="anonymous" class="form-check-input" value="1" {{ $item->anonymous === 1  ? ' checked="checked"' : null }} />
                                <label class="form-check-label" for="anonymous">Anonīms</label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Klase</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="course" id="course" placeholder="Ievadiet klasi" required="required" value="{{ $item->course ? $item->course : old('course') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="living_location" class="col-sm-2 col-form-label">Dzīvesvieta (pilsēta)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="living_location" id="living_location" placeholder="Ievadiet dzīvesvietu" value="{{ $item->living_location ? $item->living_location : old('living_location') }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="living_location" class="col-sm-2 col-form-label">Apraksts</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="story" id="story" rows="10" required="required">{{ $item->story ? $item->story : old('story') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Statuss</label>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="active" id="active" value="1" {{ $item->active === 1 || !isset($item->active)  ? ' checked="checked"' : null }} />
                                <label class="form-check-label" for="active">Publisks ieraksts</label>
                            </div>
                        </div>
                    </div>

                    @if ($item->id>0)
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Bilde</label>
                        </div>
                        <div class="col-sm-10">
                            <ul class="list-unstyled list-inline">
                                @if(count($images)>0)
                                    @foreach($images as $image)
                                    <li class="mr-3 text-center list-inline-item position-relative">
                                        <img src="/i/{{$image->filename}}?w=100&h=100&fit=crop" alt="" alt="{{$image->filename_ori}}" title="{{$image->filename_ori}}">
                                        <a class="btn btn-sm btn-danger position-absolute mt-0 ml-0" style="top:-10px; right:-10px; " href="{{route('fragment-image-remove', ['image' => $image->id])}}" onclick="return confirm('Vai tiešām vēlaties dzēst attēlu?');">&times;</a>
                                    </li>
                                    @endforeach
                                @endif
                                <li class="mr-3 text-center list-inline-item">
                                    <a href="#" class="btn btn-warning" title="" onclick="document.querySelector('.query-image-list').style.display='block'; return false;">&plus;</a>
                                </li>
                            </ul>
                            @include('app.fragments.query-image-list', ['fragment' => $item, 'images' => $imagesNotAttached])
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Saglabāt</button>
                            <a href="{{ route('fragments') }}" title="Atcelt" class="btn btn-secondary ml-2">Aizvērt</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
