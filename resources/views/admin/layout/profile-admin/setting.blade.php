@extends('admin.layout.app')


@push('styles')
<style>
    body {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }

    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #555555;
    }
</style>
@endpush

@section('content')
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                        alt="" />
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-head">
                    <h5>
                        Nguyễn Thị Linh
                    </h5>
                    <h6>
                        <span class="badge badge-light">Người kiểm duyệt</span>
                    </h6>
                    {{-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Thông tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Thay đổi thông tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#security" role="tab"
                                aria-controls="profile" aria-selected="false">Bảo mật</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                {{-- <div class="profile-work">
                    <p>WORK LINK</p>
                    <a href="">Website Link</a><br />
                    <a href="">Bootsnipp Profile</a><br />
                    <a href="">Bootply Profile</a>
                    <p>SKILLS</p>
                    <a href="">Web Designer</a><br />
                    <a href="">Web Developer</a><br />
                    <a href="">WordPress</a><br />
                    <a href="">WooCommerce</a><br />
                    <a href="">PHP, .Net</a><br />
                </div> --}}
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Họ và tên</label>
                            </div>
                            <div class="col-md-6">
                                <p>Nguyễn thị Linh</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>lunglinh@gmail.com</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Số điện thoại</label>
                            </div>
                            <div class="col-md-6">
                                <p>+84333203000</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Vai trò</label>
                            </div>
                            <div class="col-md-6">
                                <p>Người kiểm duyệt</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="pt-1">
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Name</label><input type="text"
                                        class="form-control" placeholder="first name" value=""></div>
                                <div class="col-md-6"><label class="labels">Surname</label><input type="text"
                                        class="form-control" value="" placeholder="surname"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text"
                                        class="form-control" placeholder="enter phone number" value=""></div>
                                <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text"
                                        class="form-control" placeholder="enter address line 1" value=""></div>
                                <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text"
                                        class="form-control" placeholder="enter address line 2" value=""></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                        class="form-control" placeholder="country" value=""></div>
                                <div class="col-md-6"><label class="labels">State/Region</label><input type="text"
                                        class="form-control" value="" placeholder="state"></div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button"
                                    type="button">Save Profile</button></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="pt-1">
                            <h2>Đổi mật khẩu</h2>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Mật khẩu hiện tại</label><input type="text"
                                        class="form-control" placeholder="enter phone number" value=""></div>
                                <div class="col-md-12"><label class="labels">Mật khẩu mới</label><input type="text"
                                        class="form-control" placeholder="enter address line 1" value=""></div>
                                <div class="col-md-12"><label class="labels">Nhập lại mật khẩu</label><input type="text"
                                        class="form-control" placeholder="enter address line 2" value=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection