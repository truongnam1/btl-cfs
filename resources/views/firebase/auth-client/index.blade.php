<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sample FirebaseUI App</title>
    <!-- *******************************************************************************************
       * TODO(DEVELOPER): Paste the initialization snippet from:
       * Firebase Console > Overview > Add Firebase to your web app.
       * In addition, include the firebase-auth SDK:
       * <script src="https://www.gstatic.com/firebasejs/[FIREBASE VERSION USED IN SNIPPET]/firebase-auth.js"></script> *
       ***************************************************************************************** -->
    <script src="https://www.gstatic.com/firebasejs/5.0.0/firebase.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.0.3-202181503543/firebase-database.min.js"></script> -->
    <script src="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth.js"></script>
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth.css" />
    <script src="{{asset('js/firebase/config.js')}}"></script>
    <script src="{{asset('js/firebase/common.js')}}"></script>

    <script type="text/javascript">
        // FirebaseUI config.
        var uiConfig = {
            signInSuccessUrl: 'https://test-firebase.test/auth-client/login',
            signInOptions: [
                // Leave the lines as is for the providers you want to offer your users.
                firebase.auth.GoogleAuthProvider.PROVIDER_ID,
                firebase.auth.FacebookAuthProvider.PROVIDER_ID,
                firebase.auth.TwitterAuthProvider.PROVIDER_ID,
                firebase.auth.GithubAuthProvider.PROVIDER_ID,
                firebase.auth.EmailAuthProvider.PROVIDER_ID,
                firebase.auth.PhoneAuthProvider.PROVIDER_ID,
                firebaseui.auth.AnonymousAuthProvider.PROVIDER_ID
            ],
            // tosUrl and privacyPolicyUrl accept either url string or a callback
            // function.
            // Terms of service url/callback.
            tosUrl: 'https://test-firebase.test/auth-client/login-last',
            // Privacy policy url/callback.
            privacyPolicyUrl: function() {
                window.location.assign('/');
            }
        };

        // Initialize the FirebaseUI Widget using Firebase.
        var ui = new firebaseui.auth.AuthUI(firebase.auth());
        // The start method will wait until the DOM is loaded.
        ui.start('#firebaseui-auth-container', uiConfig);
        
    </script>
</head>

<body>
    <!-- The surrounding HTML is left untouched by FirebaseUI.
         Your app may use that space for branding, controls and other customizations.-->
    <h1>Welcome to My Awesome App</h1>
    <div id="firebaseui-auth-container"></div>
    <button onclick="getToken()">lay token</button>
    <div id="token">

    </div>
</body>
<script>
        var objToken;
        function getToken() {
            objToken = firebase.auth().currentUser.getIdToken();
            if(objToken){
                console.log(objToken);
                var elementToken = document.querySelector("#token");
                console.log(objToken);
                elementToken.innerText = objToken.i;
            }
            
        }
{
    // code
};
</script>

</html>