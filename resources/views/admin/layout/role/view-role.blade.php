@extends('admin.layout.app')
@push('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
@endpush
@push('styles')
<link href="{{ asset('css/admin/role-list.css')}}" rel="stylesheet">
@endpush

@push('scripts')

<script src="{{ mix('js/admin/role/role-view.js')}}"></script>
@endpush

@php
// $teamNames = $teamNames->toArray();
@endphp

@section('content')
<div class="row">
    <div class="col-12 col-md-1">

    </div>
    <div class="col-md-10">
        <div class="mx-auto">

            <div id="role-desc" class="row">
                {{-- <input type="text" value="{{$role->desc}}"> --}}
                <div class="col-md-6 form-group">
                    <h4 >Tên vai trò</h4>
                    <div class="d-flex">
                        <input type="text" class="form-control" name="" id="" aria-describedby="helpId"
                            value="{{$role->desc}}">
                        <button type="button" class="ml-1 btn btn-primary" id="btn-save-permissions">Lưu</button>
                    </div>

                </div>
            </div>

            <table class="table table-responsive">
                <form id="form-1" role-name='{{$roleName}}'>
                    <tbody>
                        @foreach ($permissions as $key =>$permission)
                        <tr class="bg-light">
                            <td class="align-middle mr-2">
                                <p>{{$teamNames->$key}}</p>
                            </td>

                            @foreach ($permission as $item)
                            <td class="align-middle">
                                <div class="form-group form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" permission-id="{{$item->id}}">
                                        {{$item->action}}
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Check this checkbox to continue.</div>
                                    </label>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </form>
            </table>
        </div>
    </div>
    <div class="col-12 col-md-1">

    </div>
</div>


@endsection