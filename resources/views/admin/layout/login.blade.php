<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icomoon@1.0.0/style.css">

    <!-- <link rel="stylesheet" href="css/owl.carousel.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    {{-- toast --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="{{mix ('css/admin/style-login.css')}}">
    
    <script type="text/javascript">
        var urlLoginApi = `{{ route('admin-login-post')}}`;
        var urlHomeAdmin = `{{ route('admin-dashboard')}}`;
   </script>

    <title>Đăng nhập vào trang quản lý</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <div class="mb-4">
                                    <h3>Đăng nhập vào <strong>CFS</strong></h3>
                                    <p class="mb-4">Dòng chữ nói về cái gì đấy</p>
                                </div>
                                <form action="{{ route('admin-login-post')}}" method="post" id="form-login">
                                    @csrf
                                    <div class="form-group first">
                                        <label for="username">Email</label>
                                        <input type="email" class="form-control" id="input-username" required>

                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="input-password" required>

                                    </div>

                                    <div class="d-flex mb-5 align-items-center">
                                        <div class="control control--checkbox mb-0 pl-0 d-flex align-content-center">
                                            <input type="checkbox" checked="checked" />
                                            <span class="caption">Nhớ mật khẩu</span>
                                            <!-- <div class="control__indicator"></div> -->
                                        </div>
                                        <span class="ml-auto"><a href="{{route('admin-forgot-password')}}" class="forgot-pass text-decoration-none" >Quên mật khẩu</a></span>
                                    </div>

                                    <input type="button" value="Đăng nhập" class="btn btn-pill text-white btn-block btn-primary" id="input-submit">

                                    {{-- <span class="d-block text-center my-4 text-muted"> hoặc đăng nhập với</span> --}}

                                    {{-- <div class="social-login text-center">
                                        <!-- <a href="#" class="facebook">
                                            <span class="icon-facebook mr-3"></span>
                                        </a>
                                        <a href="#" class="twitter">
                                            <span class="icon-twitter mr-3"></span>
                                        </a> -->
                                        <a href="#" class="google" id="btn-login-google">
                                            <span class="icon-google mr-3"></span>
                                        </a>
                                        <button id="btn-login-facebook">facebook</button>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin-login-post')}}" method="post" id="form-token-login">
        @csrf
    </form>


    <!-- <script src="js/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> -->

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-app-compat.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-auth-compat.min.js"></script>
    <script src="{{asset('js/firebase/config.js')}}"></script>

    <script src="{{ mix('js/admin/login/login.js')}}"></script>
    <script>
        $(function() {
            'use strict';


            $('.form-control').on('input', function() {
                var $field = $(this).closest('.form-group');
                if (this.value) {
                    $field.addClass('field--not-empty');
                } else {
                    $field.removeClass('field--not-empty');
                }
            });

        });
    </script>

    <div id="info-user"></div>
    

</body>

</html>