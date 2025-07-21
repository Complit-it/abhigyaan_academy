<script>
    // Get the entire URL from the address bar
    // Get the entire URL from the address bar
    let currentUrl = window.location.href;

    // Split the URL by the fragment identifier '#'
    let parts = currentUrl.split('#');

    // parts[0] will contain everything before '#'
    let baseUrl = parts[0];
    console.log('Base URL:', baseUrl);

    // parts[1] will contain everything after '#'
    if (parts.length > 1) {
        let fragment = parts[1];
        // console.log('Fragment:', fragment);

        // Example: Extracting query parameters from fragment
        let queryParams = new URLSearchParams(fragment);
        // console.log('Query Parameters:', queryParams.toString());

        // You can access individual parameters
        let state = queryParams.get('state');
        let accessToken = queryParams.get('access_token');
        localStorage.setItem('accessToken', accessToken);

        // Handle or process these parameters as needed
    } else {
        console.log('No fragment found.');
    }

    </script>

<script src="https://apis.google.com/js/api.js"></script>
<script>
  /**
   * Sample JavaScript code for youtube.liveBroadcasts.insert
   * See instructions for running APIs Explorer code samples locally:
   * https://developers.google.com/explorer-help/code-samples#javascript
   */

   let accessToken = localStorage.getItem('accessToken');
    let apiKey = 'AIzaSyCcojvul2LlKk5FeyGwfG65Hb9___qivPs';

  function loadClient() {
    gapi.client.setApiKey(apiKey);
    return gapi.client.load("https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest")
        .then(function() { console.log("GAPI client loaded for API"); },
              function(err) { console.error("Error loading GAPI client for API", err); });
  }
  // Make sure the client is loaded before calling this method.
  function execute() {
    return gapi.client.youtube.liveBroadcasts.insert({
      "part": [
        "snippet,contentDetails,status"
      ],
      "resource": {
        "snippet": {
          "title": "Test broadcast",
          "scheduledStartTime": new Date().toISOString(),
        //   "scheduledEndTime": "YOUR_SCHEDULED_END_TIME"
        },
        "contentDetails": {
          "enableClosedCaptions": true,
          "enableContentEncryption": true,
          "enableDvr": true,
          "enableEmbed": true,
          "recordFromStart": true,
          "startWithSlate": true
        },
        "status": {
          "privacyStatus": "unlisted"
        }
      }
    })
        .then(function(response) {
                // Handle the results here (response.result has the parsed body).
                console.log("Response", response);
              },
              function(err) { console.error("Execute error", err); });
  }
  gapi.load("client");
</script>
<button onclick="loadClient()">load</button>
<button onclick="execute()">execute</button>

