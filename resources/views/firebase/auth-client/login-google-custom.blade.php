<!DOCTYPE html>
<!--
Copyright (c) 2016 Google Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->
<html>

<head>
    <meta charset=utf-8 />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sign In Example</title>

    <!-- Material Design Theming -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

    <link rel="stylesheet" href="main.css">

    <!-- Import and configure the Firebase SDK -->
    <!-- These scripts are made available when the app is served or deployed on Firebase Hosting -->
    <!-- If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-app-compat.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-auth-compat.min.js">
    </script>
    {{-- <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase.js"></script> --}}
    <script src="{{asset('js/firebase/config.js')}}"></script>


</head>

<body>
    <div class="form-group text-center">
        <button class="btn btn-block btn-social btn-google" id="btnGoogle" type="button"> <span
                class="fa fa-google"></span>Login with Google</button>
    </div>
    <div class="form-group text-center">
        <button class="btn btn-block btn-social btn-facebook" id="btnFacebook" type="button"> <span
                class="fa fa-facebook"></span>Login with Facebook</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script>
        function iniApp() {
            console.log("Khởi tạo firebase");
        //Google singin provider
            var ggProvider = new firebase.auth.GoogleAuthProvider();
            //Facebook singin provider
            var fbProvider = new firebase.auth.FacebookAuthProvider();
            //Login in variables
            const btnGoogle = document.getElementById('btnGoogle');
            const btnFaceBook = document.getElementById('btnFacebook');
            var token = null;
            var  credentiall = null;
            //Sing in with Google
            btnGoogle.addEventListener('click', e => {

                if (!firebase.auth().currentUser) {
                    // var provider = new firebase.auth.GoogleAuthProvider();
                    // ggProvider.addScope('https://www.googleapis.com/auth/plus.login');
                    // firebase.auth().signInWithRedirect(provider);
                } else {
                    firebase.auth().signOut();
                }
                firebase.auth().signInWithPopup(ggProvider).then(function(result) {
                    token = result.credential.accessToken;
                    console.log('token',result);
                    console.log('res',result);
                    credentiall = result.credential;
                    // var user = result.user;
                    // console.log('User>>Goole>>>>', user);
                    // userId = user.uid;
                  
                    
                }).catch(function(error) {
                    console.error('Error: hande error here>>>', error.code)
                })
            }, false)

            //Sing in with Facebook
            btnFaceBook.addEventListener('click', e => {
                firebase.auth().signInWithPopup(fbProvider).then(function(result) {
                    // This gives you a Facebook Access Token. You can use it to access the Facebook API.
                    var token = result.credential.accessToken;
                    // The signed-in user info.
                    var user = result.user;
                    console.log('User>>Facebook>', user);
                    // ...
                    userId = user.uid;
                
                }).catch(function(error) {
                    // Handle Errors here.
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    // The email of the user's account used.
                    var email = error.email;
                    // The firebase.auth.AuthCredential type that was used.
                    var credential = error.credential;
                    // ...
                    console.error('Error: hande error here>Facebook>>', error.code)
                });
            }, false)
        }

        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
            // User is signed in.
            var displayName = user.displayName;
            var email = user.email;
            var emailVerified = user.emailVerified;
            var photoURL = user.photoURL;
            var isAnonymous = user.isAnonymous;
            var uid = user.uid;
            var providerData = user.providerData;
            console.log(`đã dăng nhập`, user);
            } else {
            // User is signed out.
            console.log('chua dang nhap');
        
            }
        });

        window.onload = function() {
            iniApp();
        };


    </script>
</body>

</html>