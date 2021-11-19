{{-- base chung --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @routes @include('sections.head') @stack('styles')
    <title>{{ $title ?? "Không có tiêu đề" }}</title>
</head>

<body>
    @include('sections.header') @yield('content')

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- firebase --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-app-compat.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-auth-compat.min.js">
    </script>
    <script src="{{ asset('js/firebase/config.js') }}"></script>

    {{-- <script src="{{ asset('js/admin/sb-admin-2.min.js')}}"></script> --}}

    <script>
        function initApp() {
                // Listening for auth state changes.
                firebase.auth().onAuthStateChanged(function (user) {
                    // document.getElementById('quickstart-verify-email').disabled = true;
                    if (user) {
                        // User is signed in.
                        var displayName = user.displayName;
                        var email = user.email;
                        var emailVerified = user.emailVerified;
                        var photoURL = user.photoURL;
                        var isAnonymous = user.isAnonymous;
                        var uid = user.uid;
                        var providerData = user.providerData;

                        var data = {
                            displayName: displayName,
                            email: email,
                            emailVerified: emailVerified,
                            photoURL: photoURL,
                            isAnonymous: isAnonymous,
                            uid: uid,
                            providerData: providerData,
                        };
                        
                        if (!data.photoURL) {
                            photoURL = `https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg`;
                        }
                        setProfileUser(data);
                        // $('#display-name-user').text(data.displayName);
                        // $('#photo-user').attr('src', photoURL);

                        console.log(data);
                        var accessToken =
                            firebase.auth().currentUser._delegate.accessToken;

                        // setup
                        $.ajaxSetup({
                            headers: {
                                Authorization: `Bearer ${accessToken}`,
                            },
                        });
                    } else {
                        // User is signed out.
                    }
                });

                //  document.getElementById('btn-logout').addEventListener('click', function() {
                //      firebase.auth().signOut();
                //      toastr.warning('Đã đăng xuất');
                //      setTimeout(logOut, 500);
                //  });
            }

            function setProfileUser(data) {
                if (data.displayName.length > 25) {
                    var displayName = data.displayName.substring(0, 20) + '...';
                }
                $('#display-name-user').text(data.displayName);
                $('#photo-user').attr('src',data.photoURL);

            }

            window.onload = function () {
                initApp();
            };
    </script>
    @stack('scripts')
</body>

</html>