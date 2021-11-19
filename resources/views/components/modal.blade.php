{{-- @props(['content', 'footer']) --}}
<!-- Modal -->
<div  class="{{$attributes->merge(['class' => 'modal fade'])["class"] }}" id="{{$attributes->get("id")}}" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog {{$attributes["class-modal-dialog"]}} {{$attributes['modalSize']}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{$attributes['title'] ?? "Không có tiêu đề"}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$content ?? ""}}
            </div>
            <div class="modal-footer">
                {{ $footer ?? ""}}
            </div>
        </div>
    </div>
</div>