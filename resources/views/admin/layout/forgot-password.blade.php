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

    <title>Quên mật khẩu</title>
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
                                    <h3>Quên mật khẩu <strong>CFS</strong></h3>
                                    <p class="mb-4">Dòng chữ nói về cái gì đấy</p>
                                </div>
                                <form action="{{ route('admin-login-post')}}" method="post" id="form-login">
                                    @csrf
                                    <div class="form-group first">
                                        <label for="input-email">Email</label>
                                        <input type="email" class="form-control" id="input-email">
                                    </div>
                                    <input type="button" value="Gửi email"
                                        class="btn btn-pill text-white btn-block btn-primary" id="btn-submit"
                                        onclick="resetPassword()">

                                    <span class="d-block text-center my-4 text-muted"> Nếu bạn đã có tài khoản, nhấn vào
                                        <a href="{{route('admin-login')}}">Đăng nhập</a></span>


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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-app-compat.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-auth-compat.min.js">
    </script>
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

        function resetPassword() {
            var email = $('#input-email').val();
            console.log('reset pass');

            if (validateEmail(email)) {
                firebase.auth().sendPasswordResetEmail(email)
                .then(() => {
                    // Password reset email sent!
                    // ..
                    console.log('email da duoc gui');
                    toastr.success('Đã gửi email thành công');
        
                })
                .catch((error) => {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    console.log(errorCode);
                    // alert('email khong chinh xác')
                    if (errorCode == 'auth/user-not-found') {
                        toastr.error('Email không tồn tại trong hệ thống');
                    } else {
                        toastr.error(errorMessage);
                    }
                    // ..
                });
                
            } else {
                toastr.error('Email không hợp lệ');

            }
        }

//         function validateEmailToast(email) {
//     const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     return re.test(email);
// }
    </script>

    <div id="info-user"></div>


</body>

</html>