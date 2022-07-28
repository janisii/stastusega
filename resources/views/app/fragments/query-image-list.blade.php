<script type="text/javascript">
    var images = {!! $images !!}
</script>

<div class="query-image-list" style="display: none">
    <div class="form-group row mb-0">
        <div class="col-sm-6 mt-3 mb-3">
            <input type="text" class="form-control" name="query-image-list-input" value="" placeholder="Meklēt fragmentu bildes pēc vārda uzvārda"/>
        </div>
        <div class="col-sm-12">
            <ul class="list-unstyled list-inline query-image-list-results mb-0" data-attach-link="{{ route('fragment-image-attach', ['fragment' => $fragment->id, 'image' => '-1']) }}"></ul>
        </div>
    </div>
</div>