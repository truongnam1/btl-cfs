@php
$listPermission = $dataRole->permissions->teamPermission;
@endphp

<div class="card card-role p-2 bg-light border-0 shadow-sm" onclick="openNewTab('{{$dataRole->urlRole}}')">
    <div class="card-header card-header-cfs">
        <div class="card-title m-0" role-name="{{$dataRole->name}}">
            <h3 class="mb-0">{{$dataRole->desc}}</h3>
        </div>
        <div>
            <span class="font-weight-bolder">có {{$dataRole->permissions->total}} quyền</span>
        </div>
    </div>
    <div class="card-body card-body-cfs border-0 pb-2 pt-0">
        <div class="d-flex flex-column">
            @if ($dataRole->permissions->total <= 4) 
                @foreach ($listPermission as $itemPer) <div>
                    <span>{{$itemPer->text->action}} {{$itemPer->text->team_name}}</span></div>
                @endforeach

            @elseif ($dataRole->permissions->total > 4)
                @php
                    $count = 0;
                @endphp
                @foreach ($listPermission as $itemPer) 
                    @if ($count++ >= 4)
                        @break
                    @endif
                    <div><span>{{$itemPer->text->action}} {{$itemPer->text->team_name}}</span></div>
                @endforeach
                    <div>
                        <span>Và {{$dataRole->permissions->total - 4}} quyền nữa...</span>
                    </div>
            @endif
</div>
</div>
</div>