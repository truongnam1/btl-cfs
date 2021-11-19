$(document).ready(function() {
    initApp();
});

function inIGeneral() {
    const user = firebase.auth().currentUser;
    console.log('khởi tạo ban đầu');
    $('#display-name-user').text(user.displayName);
    $('#photo-user').attr('src', user.photoURL);
}

function initApp() {
    // Listening for auth state changes.
    firebase.auth().onAuthStateChanged(function(user) {
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
            }

            if (!data.photoURL) {
                photoURL = `https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg`;
            }

            inIGeneral();

            console.log(data);
            var accessToken = firebase.auth().currentUser._delegate.accessToken;
            // console.log('token', accessToken);
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer ${accessToken}`
                }
            });

        } else {
            // User is signed out.

        }
    });

    document.getElementById('btn-logout').addEventListener('click', function() {
        firebase.auth().signOut();
        toastr.warning('Đã đăng xuất');
        setTimeout(logOut, 500);
    });
}

function logOut() {

    window.location = route('admin-logout');
}