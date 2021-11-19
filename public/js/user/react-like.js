var postId = document.getElementsByClassName("title")[0].id;
var isLike = true;

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
        // $('#display-name-user').text(data.displayName);
        // $('#photo-user').attr('src', photoURL);

        // console.log(data);
        var accessToken = firebase.auth().currentUser._delegate.accessToken;

        // setup
        $.ajaxSetup({
            headers: {
                Authorization: `Bearer ${accessToken}`,
            },
        });

        $.ajax({
            url: route("CheckPostReact", { postId: postId }),
            method: "GET",
            success: function (data) {
                isLike = data["status"];
                var container = document.getElementById("action-like");
                if (isLike) {
                    container.innerHTML = '<i class="fas fa-heart fa-lg"></i>';
                } else {
                    container.innerHTML = '<i class="far fa-heart fa-lg"></i>';
                }
            },
        });

        document
            .getElementById("action-like")
            .addEventListener("click", actionLike);

        function actionLike() {
            isLike = !isLike;
            console.log(isLike);
            var container = document.getElementById("action-like");
            if (isLike) {
                container.innerHTML = '<i class="fas fa-heart fa-lg"></i>';
                $.ajax({
                    url: route("UserAddPostReact", { postId: postId }),
                    method: "GET",
                    success: function (data) {
                        console.log(data);
                    },
                });
            } else {
                container.innerHTML = '<i class="far fa-heart fa-lg"></i>';
                $.ajax({
                    url: route("UserRemovePostReact", { postId: postId }),
                    method: "GET",
                    success: function (data) {
                        console.log(data);
                    },
                });
            }
        }
    } else {
        // User is signed out.
    }
});
