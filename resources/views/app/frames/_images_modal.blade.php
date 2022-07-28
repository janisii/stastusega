<!-- Modal -->
<div class="modal fade" id="frames-image-list" tabindex="-1" role="dialog" aria-labelledby="frames-image-list" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bilžu saraksts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (count($notAttachedImages)>0)
                    <ul class="list-unstyled frame-grid gap frame-modal">
                        @foreach($notAttachedImages as $image)
                            <li>
                                <a href="#" title="" data-action="{{route('frame-image-attach')}}" data-image="{{$image->id}}" class="frame-image-attach">
                                    <img src="/i/{{$image->filename}}?w=250&h=250&fit=crop" alt="{{$image->filename_ori}}" title="{{$image->filename_ori}}" class="img-fluid">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    Bildes nav pieejamas.
                @endif
            </div>
        </div>
    </div>
</div>