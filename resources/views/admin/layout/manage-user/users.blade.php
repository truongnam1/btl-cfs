@extends('admin.layout.app')

@include('admin.sections.link-datatables')

@push('scripts')
@endpush
@push('scripts')
<script src="{{ mix('js/admin/datatable.js')}}"></script>
<script src="{{ mix('js/admin/user.js')}}"></script>

@endpush

@push('styles')
<style>
    h4 {
        letter-spacing: -1px;
        font-weight: 400
    }

    .wrapper .img {
        width: 70px;
        height: 70px;
        border-radius: 6px;
        object-fit: cover
    }

    #img-section p,
    #deactivate p {
        font-size: 12px;
        color: #777;
        margin-bottom: 10px;
        text-align: justify
    }

    #img-section b,
    #img-section button,
    #deactivate b {
        font-size: 14px
    }

    label {
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 500;
        color: #777;
        padding-left: 3px
    }
</style>
@endpush

@section('content')

<div class="card shadow mb-4 mx-3">
    <div class="card-header py-3">
        <div class="card-title">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>

    </div>
    <div class="card-body">
        <div class="mb-2 d-flex">
            <button class="btn btn-secondary mr-2" data-toggle="modal" data-target="#modal-create-user">Tạo tài
                khoản</button>
            

        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Người dùng</th>
                        <th>Vai trò</th>
                        <th>Ngày đăng ký</th>
                        <th>Trạng thái tài khoản</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>
                            11964655131165
                        </td>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="" style="width : 50px">
                                <a href="#">
                                    <div class="symbol-label">
                                        <img src="https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg"
                                            alt="Emma Smith" class="w-100">
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->

                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-800 text-hover-primary mb-1">Nguyễn Văn A</a>
                                <div class="d-flex">
                                    <span class="mr-1"><i class="fas fa-envelope-square"></i></span>
                                    <span class="mr-1"><i class="fab fa-google"></i></span>
                                    <span class="mr-1"><i class="fas fa-phone"></i></span>
                                </div>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-pill badge-secondary">User</span>
                        </td>
                        <td>20 Jun 2021, 9:23 pm</td>
                        <td> <span class="badge badge-pill badge-secondary">Đã kích hoạt</span></td>
                        <td class="d-flex">
                            <a href="#">
                                <span data-toggle="modal" data-target="#modal-view-user">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </a>
                            <span data-toggle="modal" data-target="#modal-edit-info">
                                <i class="fas fa-edit"></i>
                            </span>
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
                                    <a class="dropdown-item" href="#">Chi tiết tài khoản</a>
                                    <a class="dropdown-item" href="#">Khoá tài khoản</a>
                                    <a class="dropdown-item" href="#">Chỉnh sửa thông tin</a>
                                    <a class="dropdown-item" href="#">Đổi mật khẩu</a>

                                </div>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal tạo tài khoản --}}
<x-modal id="modal-create-user" title="Tạo tài khoản mới">
    <x-slot name="content">
        <div class="wrapper bg-white mt-1">
            <div class="d-flex align-items-start py-3 border-bottom">
                <img src="https://images.pexels.com/photos/1037995/pexels-photo-1037995.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                    class="img" alt="">
                <div class="pl-sm-4 pl-2" id="img-section"> <b>Ảnh đại diện</b>
                    <p>Chấp nhận kiểu tệp .png. Không lớn hơn 1MB</p> <button
                        class="btn btn-light"><b>Upload</b></button>
                </div>
            </div>
            <div class="py-2">
                <div class="row py-2">
                    <div class="col-md-6">
                        <label for="firstname">Họ và tên</label>
                        <input type="text" class="bg-light form-control" placeholder="Nam" name="fullname">
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="bg-light form-control" placeholder="steve_@email.com" name="email">
                    </div>
                </div>
                <div class="row py-2">

                    <div class="col-md-6">
                        <label for="country">Vai trò</label>
                        <select name="role" id="role-slelect" class="bg-light custom-select" multiple=>
                            {{-- <option value="1">Quản trị viên</option>
                            <option value="2">Kiểm duyệt</option>
                            <option value="3">Người dùng</option> --}}
                        </select>

                    </div>

                </div>
                <div class="row py-2">
                    <div class="col-md-6">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switch-active" name="active-acc"
                                checked>
                            <label class="custom-control-label" for="switch-active">Kích hoạt tài khoản</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" name="submit" id="btn-create-user">Tạo tài khoản</button>
    </x-slot>
</x-modal>

{{-- chỉnh sửa thông tin người dùng --}}
<x-modal id="modal-edit-info" title="Chỉnh sửa thông tin">
    <x-slot name="content">
        <div class="wrapper bg-white mt-1">
            <div class="d-flex align-items-start py-3 border-bottom">
                <img name="image-user"
                    src="https://images.pexels.com/photos/1037995/pexels-photo-1037995.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                    class="img" alt="">
                <div class="pl-sm-4 pl-2" id="img-section"> <b>Ảnh đại diện</b>
                    <p>Chấp nhận kiểu tệp .png. Không lớn hơn 1MB</p> <button class="btn btn-light"
                        name="btn-upload-image"><b>Upload</b></button>
                </div>
            </div>
            <div class="py-2">
                <div class="row py-2">
                    <div class="col-md-6">
                        <label for="">Tên</label>
                        <input type="text" class="bg-light form-control" placeholder="Nam" name="fullname">
                    </div>
                    <div class="col-md-6">
                        <label for="country">Vai trò</label>
                        <select name="roles" class="bg-light custom-select" multiple>
                            <option value="india">Quản trị viên</option>
                            <option value="usa">Kiểm duyệt</option>
                            <option value="uk">Người dùng</option>
                        </select>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-6">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="active-acc">
                            <label class="custom-control-label">Kích hoạt tài khoản</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" name="btn-submit">Lưu thay dổi</button>
    </x-slot>
</x-modal>

{{-- modal xoá user --}}
<x-modal modalSize="modal-sm" id="modal-delete-user">
    <x-slot name="content">
        <p>Bạn muốn xoá ... này ?</p>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" name="btn-submit" data-dismiss="modal">Đúng</button>
    </x-slot>
</x-modal>

{{-- modal đổi mật khẩu --}}
<x-modal modalSize="modal-sm" id="modal-change-password">
    <x-slot name="content">
        <p>Khi xác nhận lựa chọn này, một đường dẫn đổi mật khẩu sẽ được gửi đến email của người dùng này</p>
    </x-slot>
    <x-slot name="footer" class="text-sm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" name="btn-submit">Xác nhận</button>
    </x-slot>
</x-modal>

@endsection