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
        max-width: 50%;
        /* height: 100%; */
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

@push('scripts')
<script src="{{ mix('js/admin/profile/overview.js')}}"></script>
    
@endpush

@section('content')
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img name="image-user" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                        alt="" />
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5 id="fullname-user-header">
                        ...
                    </h5>

                    {{-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Th??ng tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#update-profile" role="tab"
                                aria-controls="update-profile" aria-selected="false">Ch???nh s???a</a>
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
                                <label>H??? v?? t??n</label>
                            </div>
                            <div class="col-md-6">
                                <p name="fullname"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p name="email"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Vai tr??</label>
                            </div>
                            <div class="col-md-6" name="roles">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="update-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="usr">H??? v?? t??n:</label>
                                    <input type="text" class="form-control" name="fullname">
                                </div>
                                <button type="button" name="btn-submit-fullname" id="" class="btn btn-primary">L??u</button>
                            </div>
                            {{-- <div class="col-md-2 d-flex align-???tems-ends">
                                  <button type="button" name="" id="" class="btn btn-primary btn-lg btn-block">L??u</button>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <hr>
                            </div>
                        </div>
                        <h3>?????i m???t kh???u</h3>
                        <div class="row my-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="usr">M???t kh???u hi???n t???i:</label>
                                    <input type="text" class="form-control" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">M???t kh???u m???i:</label>
                                    <input type="text" class="form-control" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Nh???p l???i m???t kh???u m???i:</label>
                                    <input type="text" class="form-control" name="repeat_new_password">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" name="btn-submit-password">?????i m???t kh???u</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection