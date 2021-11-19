@extends('admin.layout.profile')


@section('tab-item')
<li class="nav-item">
    <a class="nav-link active" id="tab-show" data-toggle="tab" href="#tab-show-content" role="tab" aria-controls="home"
        aria-selected="true">Thông tin</a>
</li>
@endsection



@section('tab-item-content')
<div class="tab-pane fade show active" id="tab-show-content" role="tabpanel" aria-labelledby="tab-show">
    <div class="row">
        <div class="col-md-6">
            <label>Họ và tên</label>
        </div>
        <div class="col-md-6">
            <p>{{$dataUser->displayName ?? ''}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Vai trò</label>
        </div>
        <div class="col-md-6">
            <p>
                @foreach ($roles as $role)
                <span class="badge badge-pill badge-secondary">{{$role->desc}}</span>
                @endforeach
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Email</label>
        </div>
        <div class="col-md-6">
            <p>{{$dataUser->email}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Số điện thoại</label>
        </div>
        <div class="col-md-6">
            <p>{{$dataUser->phoneNumber}}</p>
        </div>
    </div>
</div>
@endsection