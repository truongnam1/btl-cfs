@extends('admin.layout.app')

@include('admin.sections.link-datatables')

@push("scripts")

@endpush


@push('scripts')
<script src="{{ mix('js/admin/tag/datatable.js')}}"></script>
<script src="{{ mix('js/admin/tag/tag.js')}}"></script>

@endpush

@section('content')

<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <div class="card-title">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>

    </div>
    <div class="card-body">
        <div class="mb-2 d-flex ">
            <button class="btn btn-secondary mr-2" data-toggle="modal" data-target="#modal-create-tag">Tạo nhãn</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên nhãn</th>
                        <th>Mô tả</th>
                        <th>Người tạo</th>
                        <th>Số lượt dùng</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Học hành</td>
                        <td>Học hành là gì</td>

                        <td>
                            <a href="#">Nguyễn Vân Mây</a>
                        </td>
                        <td>1314</td>
                        <td>20 Jun 2021, 9:23 pm</td>
                        <td>
                            <span data-toggle="modal" data-target="#modal-view-tag">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span data-toggle="modal" data-target="#modal-delete-tag">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span data-toggle="modal" data-target="#modal-edit-tag">
                                <i class="fas fa-edit"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- modal xoá tag --}}
<x-modal modalSize="modal-sm" id="modal-delete-tag" title="Xoá nhãn">
    <x-slot name="content">
        <p tag-id class="content-warning">Bạn muốn xoá nội dung này?</p>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" name="btn-submit-tag" data-dismiss="modal">Đúng</button>
    </x-slot>
</x-modal>

{{-- modal thêm tag --}}
<x-modal id="modal-create-tag" title="Tạo nhãn mới">
    <x-slot name="content">
        <div>
            <div class="form-group">
                <label for="">Tên nhãn</label>
                <input type="text" name="name-tag" id="" class="form-control" placeholder="Học hành" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Help text</small>
            </div>
            <div class="form-group">
                <label for="">Mô tả nhãn</label>
                <textarea class="form-control" name="desc-tag" id="" rows="3" placeholder="nội dung mô tả nhãn"></textarea>
            </div>
        </div>

    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
        <button type="button" class="btn btn-primary" name="btn-submit-tag" data-dismiss="modal">Lưu</button>
    </x-slot>
</x-modal>

{{-- modal xem tag --}}
<x-modal id="modal-view-tag" title="Xem nhãn">
    <x-slot name="content">
        <div>
            <div class="form-group">
                <label for="">Tên nhãn</label>
                {{-- <input type="text" name="" id="" class="form-control" value="Học hành" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Help text</small> --}}
                <p class="text-content text-body" data-text="name-tag">hi</p>
            </div>
            <div class="form-group">
                <label for="">Mô tả nhãn</label>
                {{-- <textarea class="form-control" name="" id="" rows="3">nội dung mô tả nhãn cũ</textarea> --}}
                <p class="text-content text-body" data-text="desc-tag">hi</p>

            </div>
        </div>

    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
    </x-slot>
</x-modal>

{{-- modal edit tag --}}
<x-modal id="modal-edit-tag" title="Chỉnh sửa nhãn">
    <x-slot name="content">
        <div class="form-data" tag-id="">
            <div class="form-group">
                <label for="">Tên nhãn</label>
                <input type="text" name="name-tag" id="" class="form-control" value="Học hành" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Help text</small>
            </div>
            <div class="form-group">
                <label for="">Mô tả nhãn</label>
                <textarea class="form-control" name="desc-tag" id="" rows="3">nội dung mô tả nhãn cũ</textarea>
            </div>
        </div>

    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" name="btn-submit-tag">Lưu</button>
    </x-slot>
</x-modal>
@endsection