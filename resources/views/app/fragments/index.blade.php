@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Fragmenti <a href="{{route('fragments-create')}}" title="Jauns" class="btn btn-link">Pievienot jaunu</a> <a href="{{route('fragments')}}?noimages=true" title="Bez attēla" class="btn btn-link">Bez attēla</a></h2>
                <p>
                    Saraksts ar visiem stāstu segas fragmentiem un stāstiem.
                </p>
                @if (count($items) > 0)

                    {{ $items->links() }}

                    <div class="table-responsive">
                        <table class="table table-hover table-light table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:80px;">ID</th>
                                    <th style="width:110px;">Attēls</th>
                                    <th style="width: 200px;">Vārds Uzvārds</th>
                                    <th class="text-center">Klase</th>
                                    <th>Dzīvesvieta (pilsēta)</th>
                                    <th>Apraksts</th>
                                    <th class="text-center" style="width:80px;">Anonīms</th>
                                    <th class="text-center" style="width:80px;">Statuss</th>
                                    <th class="text-center" style="width:80px;">?</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <?php
                                $bgColor = $item->first_image ? ' style=background-color:' . $item->first_image->image_background_hex . ';' : null; ?>
                                <tr>
                                    <td class="text-center"><a href="{{route('fragments-show' , ['fragment' => $item->id])}}" title="Apskatīt">{{$item->id}}</a></td>
                                    @if ($item->first_image)
                                    <td style="background-color: {{$item->first_image->background_hex}}">
                                        <img src="/i/{{$item->first_image->filename}}?w=100&h=100&fit=crop" alt="{{$item->first_image->filename_ori}}" title="{{$item->first_image->filename_ori}}">
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>
                                        @if (!$item->anonymous)
                                            <a href="{{route('fragments-edit' , ['fragment' => $item->id])}}" title="Apskatīt">{{$item->name}}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$item->course}}</td>
                                    <td>{{$item->living_location}}</td>
                                    <td>
                                        {{$item->story}}
                                        @if (count($item->images)>1)
                                            <div class="mt-2">
                                            @foreach($item->images as $i)
                                                <img src="/i/{{$i->filename}}?w=30&h=30&fit=crop" alt="{{$i->filename_ori}}" />
                                            @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->anonymous)
                                            <span class="text-success">Jā</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->active)
                                            <span class="text-success">Publisks</span>
                                        @else
                                            <span class="text-danger">Izslēgts</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('fragments-edit' , ['fragment' => $item->id])}}" title="Rediģēt">Rediģēt</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $items->links() }}

                @endif
            </div>
        </div>
    </div>
@endsection
