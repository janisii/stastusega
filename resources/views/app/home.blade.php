@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="d-flex align-items-center justify-content-center mt-1 mb-4">
                <div class="flex-grow-1"><hr style="margin:0;"></div>
                <h3 class="ml-3 mr-3 text-center" style="margin:0; padding:0;">Stāsti bez segas gabaliņa ({{ count($storiesWithoutImage) }})</h3>
                <div  class="flex-grow-1"><hr style="margin:0;"></div>
            </div>

            @include('app._fragment-cards', ['items' => $storiesWithoutImage])

            <div class="d-flex align-items-center justify-content-center mt-4 mb-4">
                <div class="flex-grow-1"><hr style="margin:0;"></div>
                <h3 class="ml-3 mr-3 text-center" style="margin:0; padding:0;">Segas gabaliņš bez stāsta ({{ count($imagesWithoutStory) }})</h3>
                <div  class="flex-grow-1"><hr style="margin:0;"></div>
            </div>

            @include('app._fragment-cards', ['items' => $imagesWithoutStory])
        </div>
    </div>
</div>
@endsection
