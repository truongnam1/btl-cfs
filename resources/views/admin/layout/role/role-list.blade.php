@extends('admin.layout.app')

@push('styles')
<link href="{{ mix('css/admin/role-list.css')}}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ mix('js/admin/role/role-list.js')}}"></script>
@endpush
@php


// dd($dataRoles);
$dataRoless = $dataRoles->data;
@endphp

@section('content')

<div class="row mx-1">
    {{-- @for($i = 1; $i < 10; $i++) <div class="col-12 col-sm-6 col-md-4 mb-1">
        @include('admin.sections.role.card',[$dataRoles])
</div>
@endfor --}}

@foreach ($dataRoless as $dataRole)
@if ($dataRole->name != 'super-admin')
    <div class="col-12 col-sm-6 col-md-4 mb-1">
        @include('admin.sections.role.card',[$dataRole])
    </div>

@endif
@endforeach
</div>

@endsection