<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng nhập/Đăng ký</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-box">
                    <div class="button-box">
                        <div id="btn"></div>
                        <button type="button" class="toggle-btn" onclick="login()">Đăng Nhập</button>
                        <button type="button" class="toggle-btn" onclick="register()">Đăng ký</button>
                    </div>

                    {{-- đăng nhập --}}
                    <form action="{{ route('api-login-user') }}" class="input_group" id="input_login" method="post">
                        <input type="text" class="input-field" id="login-email" placeholder="Tài khoản email"
                            required />
                        <input type="password" class="input-field" id="login-password" placeholder="Mật khẩu" required />
                        <input type="checkbox" class="check-box" id="check-box" />
                        <label for="check-box">Nhớ mật khẩu</label>
                        <input type="button" class="submit-btn" id="sign-in" value="Đăng nhập">
                    </form>

                    {{-- đăng ky --}}
                    <form action="api-register-user" class="input_group" id="input_register" method="post">
                        <input type="text" class="input-field" id="register-email" placeholder="Email" required />
                        <input type="password" class="input-field" id="register-password" placeholder="Mật khẩu" required />
                        <input type="password" class="input-field" id="register-password-repeat" placeholder="Nhập lại mật khẩu" required />
                        <button type="button" class="submit-btn" id="sign-up">Đăng ký</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<form action="{{ route('api-login-user')}}" method="post" id="form-token-login">
    @csrf
</form>
<form action="{{ route('api-register-user')}}" method="post" id="form-token-register">
    @csrf
</form>

<script>
    var x = document.getElementById("input_login");
    var y = document.getElementById("input_register");
    var z = document.getElementById("btn");

    function register() {
        x.style.left = "-400px";
        y.style.left = "90px";
        z.style.left = "115px";
    }

    function login() {
        x.style.left = "90px";
        y.style.left = "490px";
        z.style.left = "0px";
    }
</script>

@push('scripts')
<script type="text/javascript">
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validateFormSignUp(data) {
        if (!validateEmail(data.email)) {
            toastr.error('Email không hợp lệ');
            return false;
        }

        if (data.password.length == 0) {
            toastr.error('Mật khẩu không được để trống');

            return false;
        }

        if (data.passwordRepeat.length == 0) {
            toastr.error('Nhập lại mật khẩu không được để trống');
            return false;
        }

        if (data.password.length <= 6) {
            toastr.error('Độ dài mật khẩu phải lớn hơn 6');
            return false;
        }

        if (data.passwordRepeat !== data.password) {
            toastr.error('Mật khẩu và nhập lại mật khẩu không giống nhau');
            return false;
        }

        return true;
        }

    function toggleSignIn() {
        if (firebase.auth().currentUser) {
            firebase.auth().signOut();
        } else {
            var email = document.getElementById('login-email').value;
            var password = document.getElementById('login-password').value;
            var password = document.getElementById('login-password').value;
            
            console.log(email, password);
            
            // Sign in with email and pass.
            firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                if (errorCode === 'auth/wrong-password') {
                    alert('Sai mật khẩu đăng nhập.');
                } else {
                    alert(errorMessage);
                }
                console.log(error);
            });
        }

        firebase.auth().onAuthStateChanged(function(user) {
            if(user) {
                var token = firebase.auth().currentUser._delegate.accessToken;
                var data = {
                    token: token
                }
                postLogin(data);
            }
        });
    }

    /**
     * Handles the sign up button press.
     */
    function handleSignUp() {
        var email = document.getElementById('register-email').value;
        var password = document.getElementById('register-password').value;
        var passwordRepeat = document.getElementById('register-password-repeat').value;

        var dataValidate = {
            email : email,
            password : password,
            passwordRepeat :passwordRepeat
        };

        if (!validateFormSignUp(dataValidate)) {
            return;
        }


        firebase.auth().createUserWithEmailAndPassword(email, password).then((userCredential) => {
            // Signed in 
            var user = userCredential.user;
            console.log(user);
            var token = firebase.auth().currentUser._delegate.accessToken;
            var data = {
                token :token
            }
            postRegister(data)

            // ...
        }).catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            if (errorCode == 'auth/weak-password') {
                // alert('The password is too weak.');
                toastr.error('Độ dài mật khẩu phải lớn hơn 6');
            } else if ('auth/email-already-in-use' == errorCode) {
                toastr.error('Email này đã được sử dụng');
                // alert('Email này đã được sử dụng');
            }
            
            else {
                toastr.error(errorMessage);
            }
            console.log(error);
            console.log(errorCode);
        });
    }

    /**
     * Sends an email verification to the user.
     */
    function sendEmailVerification() {
        firebase.auth().currentUser.sendEmailVerification().then(function() {
            // Email Verification sent!
            alert('Email Verification Sent!');
        });
    }

    function sendPasswordReset() {
      var email = document.getElementById('email').value;
      firebase.auth().sendPasswordResetEmail(email).then(function() {
        // Password Reset Email Sent!
        alert('Password Reset Email Sent!');
      }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        if (errorCode == 'auth/invalid-email') {
          alert(errorMessage);
        } else if (errorCode == 'auth/user-not-found') {
          alert(errorMessage);
        }
        console.log(error);
      });
    }

    /**
     * initApp handles setting up UI event listeners and registering Firebase auth listeners:
     *  - firebase.auth().onAuthStateChanged: This listener is called when the user is signed in or
     *    out, and that is where we update the UI.
     */

    function postLogin(data) {
        var input = `<input type="text" name="token" value="${data.token}" style="
        display: none;">`;
        $('#form-token-login').append(input);

        $('#form-token-login').submit();
        console.log(`token`, data);
    }

    function postRegister(data) {
        var input = `<input type="text" name="token" value="${data.token}" style="
        display: none;">`;
        $('#form-token-register').append(input);

        $('#form-token-register').submit();
    }

    function initAppp() {


        // Listening for auth state changes.
        // firebase.auth().onAuthStateChanged(function(user) {
        //     // document.getElementById('verify-email').disabled = true;
        //     document.getElementById('sign-in').disabled = false;
        //     if(user) {
        //         var token = firebase.auth().currentUser._delegate.accessToken;
        //         var data = {
        //             token: token
        //         }
        //         postLogin(data);
        //     }
        // });
        document.getElementById('sign-in').addEventListener('click', toggleSignIn, false);
        document.getElementById('sign-up').addEventListener('click', handleSignUp, false);

        document.querySelector('.action-link.register a').addEventListener('click', function (e) {
            console.log('click dang ky');
            register();
        }, false);

        document.querySelector('.action-link.login a').addEventListener('click', function (e) {
            console.log('click dang nhap');

            login();
        },false);

        // document.getElementById('verify-email').addEventListener('click', sendEmailVerification, false);
        // document.getElementById('password-reset').addEventListener('click', sendPasswordReset, false);
    }

    $( document ).ready(function() {
        initAppp();
    });
</script>
@endpush