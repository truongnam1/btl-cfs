function toggleSignIn() {
    if (firebase.auth().currentUser) {
        firebase.auth().signOut();
    } else {
        var email = document.getElementById('input-username').value;
        var password = document.getElementById('input-password').value;

        if (validateFormInput({ email: email, password: password })) {
            console.log('dang dang nhap');
            // Sign in with email and pass.
            firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                if (errorCode === 'auth/wrong-password') {
                    console.log('Wrong password.');
                    toastr.error('Mật khẩu không chính xác');

                } else if ('auth/user-not-found' == errorCode) {
                    toastr.error('Người dùng không tồn tại');
                } else if ('auth/too-many-requests') {
                    toastr.error('Tài khoản của bạn tạm thời bị khoá do đăng nhập sai mật khẩu quá nhiều lần');

                } else {
                    alert(errorMessage);
                }
                console.log(error);

            });
        }
    }

}

function sendPasswordReset() {
    var email = document.getElementById('email').value;

    if (!validateEmail(email)) {
        return;
    }
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
function initApp() {
    // var ggProvider = new firebase.auth.GoogleAuthProvider();
    // var fbProvider = new firebase.auth.FacebookAuthProvider();


    // const btnGoogle = document.getElementById('btn-login-google');
    // const btnFB = document.getElementById('btn-login-facebook');


    //Sing in with Google
    // btnGoogle.addEventListener('click', e => {

    //     if (!firebase.auth().currentUser) {

    //     } else {
    //         firebase.auth().signOut();
    //     }
    //     firebase.auth().signInWithPopup(ggProvider).then(function(result) {
    //         token = result.credential.accessToken;
    //         console.log('token', token);
    //         console.log('res', result);
    //         credentiall = result.credential;
    //         // var user = result.user;
    //         // console.log('User>>Goole>>>>', user);
    //         // userId = user.uid;


    //     }).catch(function(error) {
    //         console.error('Error: hande error here>>>', error.code)
    //     })
    // }, false)

    //Sing in with fb
    // btnFB.addEventListener('click', e => {

    //     if (!firebase.auth().currentUser) {

    //     } else {
    //         firebase.auth().signOut();
    //     }
    //     firebase.auth().signInWithPopup(fbProvider).then(function(result) {
    //         // token = result.credential.accessToken;
    //         // console.log('token', token);
    //         // console.log('res', result);
    //         // credentiall = result.credential;
    //         // var user = result.user;
    //         // console.log('User>>Goole>>>>', user);
    //         // userId = user.uid;


    //     }).catch(function(error) {
    //         console.error('Error: hande error here>>>', error.code)
    //     })
    // }, false)

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
            console.log(data);
            toastr.success('đăng nhập thành công');

            var token = firebase.auth().currentUser._delegate.accessToken;
            var data = {
                token: token
            }
            postLogin(data);

        } else {
            // User is signed out.

        }
    });

    document.getElementById('input-submit').addEventListener('click', toggleSignIn);
}

window.onload = function() {
    initApp();
};