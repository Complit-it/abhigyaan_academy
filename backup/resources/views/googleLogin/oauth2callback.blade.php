 <!-- resources/views/oauth2callback.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>OAuth2 Callback</title>
</head>
<body>

    <script>
         function parseFragmentString(fragmentString) {
            var params = {};
            var regex = /([^&=]+)=([^&]*)/g, m;
            while (m = regex.exec(fragmentString)) {
                params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            return params;
        }
        var fragmentString = location.hash.substring(1);
        var params = parseFragmentString(fragmentString);
        console.log(params);

        
        var accessToken = params['access_token'];
        // var url = `https://www.googleapis.com/oauth2/v3/tokeninfo?id_token={${accessToken}`;

        fetch('https://www.googleapis.com/oauth2/v3/userinfo', {
  headers: {
    'Authorization': `Bearer ${accessToken}`
  }
})
.then(response => response.json())
.then(data => {
  console.log('Profile Info:', data);
})
.catch(error => {
  console.error('Error fetching profile info:', error);
});


        // $.ajax({
        // type: 'GET',
        // url: url,
        // async: false,
        // success: function(userInfo) {
        //     //info about user
        //     console.log(userInfo);
        //     console.log('test');
        // },
        // error: function(e) {
        //     console.log('error');

        // }
        // });
        // use the above in vanilla JS
        // var xhr = new XMLHttpRequest();
        // xhr.open('GET', url, true);
        // xhr.onreadystatechange = function() {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         var userInfo = JSON.parse(xhr.responseText);
        //         console.log(userInfo);
        //     }
        // };
        // xhr.send();



        </script>

{{--   <script>
        // Function to parse the fragment string
       

        // Extract the fragment string from the URL
        var params = parseFragmentString(fragmentString);

        // Handle the extracted parameters
        if (Object.keys(params).length > 0 && params['state']) {
            if (params['state'] == localStorage.getItem('state')) {
                localStorage.setItem('oauth2-test-params', JSON.stringify(params));
                trySampleRequest();
            } else {
                console.log('State mismatch. Possible CSRF attack');
            }
        }

        // Function to make an API request using the access token
        function trySampleRequest() {
            var params = JSON.parse(localStorage.getItem('oauth2-test-params'));
            if (params && params['access_token']) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'https://www.googleapis.com/drive/v3/about?fields=user&access_token=' + params['access_token']);
                xhr.onreadystatechange = function (e) {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.response);
                    } else if (xhr.readyState === 4 && xhr.status === 401) {
                        // Token invalid, so prompt for user permission.
                        oauth2SignIn();
                    }
                };
                xhr.send(null);
            } else {
                oauth2SignIn();
            }
        }

        // Function to generate a random state value
        function generateCryptoRandomState() {
            const randomValues = new Uint32Array(2);
            window.crypto.getRandomValues(randomValues);

            // Encode as UTF-8
            const utf8Encoder = new TextEncoder();
            const utf8Array = utf8Encoder.encode(
                String.fromCharCode.apply(null, randomValues)
            );

            // Base64 encode the UTF-8 data
            return btoa(String.fromCharCode.apply(null, utf8Array))
                .replace(/\+/g, '-')
                .replace(/\//g, '_')
                .replace(/=+$/, '');
        }

        // Function to start the OAuth 2.0 flow
        function oauth2SignIn() {
            // create random state value and store in local storage
            var state = generateCryptoRandomState();
            localStorage.setItem('state', state);

            // Google's OAuth 2.0 endpoint for requesting an access token
            var oauth2Endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';

            // Create element to open OAuth 2.0 endpoint in new window.
            var form = document.createElement('form');
            form.setAttribute('method', 'GET'); // Send as a GET request.
            form.setAttribute('action', oauth2Endpoint);

            // Parameters to pass to OAuth 2.0 endpoint.
            var params = {
                'client_id': '{{ env("GOOGLE_CLIENT_ID") }}',
                'redirect_uri': '{{ env("GOOGLE_REDIRECT_URI") }}',
                'scope': 'https://www.googleapis.com/auth/drive.metadata.readonly',
                'state': state,
                'include_granted_scopes': 'true',
                'response_type': 'token'
            };

            // Add form parameters as hidden input values.
            for (var p in params) {
                var input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', p);
                input.setAttribute('value', params[p]);
                form.appendChild(input);
            }

            // Add form to page and submit it to open the OAuth 2.0 endpoint.
            document.body.appendChild(form);
            form.submit();
        }

        // Call the trySampleRequest function when the page loads
        window.onload = trySampleRequest;
    </script>

    <button onclick="trySampleRequest();">Try sample request</button>--}}
</body>
</html> 
