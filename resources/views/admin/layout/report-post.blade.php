@extends('admin.layout.app')

@include('admin.sections.link-datatables')
@push("scripts")
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush

@section('content')
<h1>view role</h1>
<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <div class="card-title">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                        <th>Bài viết</th>
                        <th>Trạng thái xử lý</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung báo cáo</th>
                        <th>Thời gian báo cáo</th>
                        <th>Hành động</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#">199875682525</a></td>
                        <td>
                            <span class="badge badge-pill badge-warning">Chưa xử lý</span>
                        </td>
                        <td>Xúc phạm danh dự</td>
                        <td>Ngày nay, nhiều người bị ám ảnh bởi hội chứng
                        </td>
                        <td>20 Jun 2021, 9:23 pm</td>
                        <td>
                            <div class="dropdown no-arrow mb-4">
                                <button
                                    class="btn btn-secondary dropdown-toggle btn-sm btn-icon btn-light btn-active-light-primary"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect x="10" y="10" width="4" height="4" rx="2" fill="black"></rect>
                                            <rect x="17" y="10" width="4" height="4" rx="2" fill="black"></rect>
                                            <rect x="3" y="10" width="4" height="4" rx="2" fill="black"></rect>
                                        </svg>
                                    </span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#open-report">Xem báo cáo</a>
                                    <a class="dropdown-item" href="#">Xoá bài viết</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal delete --}}
<x-modal modalSize="modal-sm" id="delete-report">
    <x-slot name="content">
        <p>Bạn muốn xoá báo cáo này ?</p>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Đúng</button>
    </x-slot>
</x-modal>

{{-- modal open report --}}
<x-modal id="open-report" title="Báo cáo bài viết" class-modal-dialog="modal-dialog-scrollable">
    <x-slot name="content">
        <div class="d-flex justify-content-between">
            <div class="mb-2">
                <span>Bài viết</span>
                <a href="#">199875682525</a>
            </div>
            <div class="mb-2">
                <span>Bài viết của</span>
                <a href="#">Nguyễn Văn A</a>
            </div>
        </div>
        <div class="mb-2">
            <span>Người báo cáo</span>
            <a href="#">Nguyễn Văn B</a>
        </div>
        <div class="mb-2">
            <span>Trạng thái</span>
            <select name="" id="" class="custom-select custom-select-sm">
                <option value="">Chưa xử lý</option>
                <option value="">Đang xử lý</option>
                <option value="">Đã xử lý</option>
            </select>
        </div>
        <div class="mb-2">
            <span>Tiêu đề</span>
            <div>Xúc phạm danh dự</div>
        </div>
        <div class="mb-2">
            <span>Nội dung</span>
            <div>
                <p>
               1. Phức cảm cô gái tốt bụng<br>
                    Ngày nay, nhiều người bị ám ảnh bởi hội chứng “phức cảm cô gái tốt bụng” nghĩa là người ôm trong mình khao khát được công nhận quá mãnh liệt. Tuy nhiên cũng chính vì thế mà chúng ta cho rằng “muốn được công nhận thì mình phải làm hết mọi việc” rồi đâm đầu vào ôm đồm, cố gắng đáp ứng mọi nhu cầu mà người khác đặt ra. Dần dần điều này khiến chúng ta mệt mỏi, kiệt sức và thấy bất mãn với mọi thứ xung quanh. 
                </p>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        {{-- <button type="button" class="btn btn-primary">Đúng</button> --}}
    </x-slot>
</x-modal>

@endsection