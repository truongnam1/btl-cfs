@extends('admin.layout.app')

@include('admin.sections.link-datatables')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.6.4/css/keyTable.bootstrap4.min.css">
@endpush

@push("scripts")
<script src="https://cdn.datatables.net/keytable/2.6.4/js/dataTables.keyTable.min.js"></script>

@endpush

@push('scripts')
<script src="{{ mix('js/admin/permission/datatable.js')}}"></script>
<script src="{{ mix('js/admin/permission/permission.js')}}"></script>

@endpush

@section('content')

<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <div class="card-title">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>

    </div>
    <div class="card-body">
        {{-- <div class="mb-2">
            <button class="btn btn-secondary" data-toggle="modal" data-target="#create-permission">Tạo mới</button>
        </div> --}}
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quyền có trong vai trò</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bài đăng</td>
                        <td>
                            <span class="badge badge-pill badge-secondary">Administrator</span>
                            <span class="badge badge-pill badge-secondary">User</span>
                        </td>
                        <td>20 Jun 2021, 9:23 pm</td>
                        <td>
                            <span data-toggle="modal" data-target="#modal-edit-permission" id="btn-edit-permission">
                                <i class="fas fa-edit"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- modal edit --}}
<x-modal id="modal-edit-permission" title="Sửa mô tả quyền">
    <x-slot name="content" class="font-bold">
        <div class="form-group form-data">
            <label for="">Mô tả quyền</label>
            <input type="text" class="form-control" name="desc-permission" id="" aria-describedby="helpId" placeholder="Bài viết">
            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>
    </x-slot>

    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" name="btn-submit-permission" data-dismiss="modal">Lưu chỉnh sửa</button>
    </x-slot>
</x-modal>
@endsection