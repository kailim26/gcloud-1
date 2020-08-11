
	var upload = {};
	(function(b){
    // The Browser API key obtained from the Google API Console.
    // Replace with your own Browser API key, or your own key.
    var developerKey = 'AIzaSyBtGkAnDdXzbjMCA7up9sEbq2nbOoEYxC8';

    // The Client ID obtained from the Google API Console. Replace with your own Client ID.
    var clientId = "517220932654-28b347kp4ab63dt7do8amaqtat4in1os.apps.googleusercontent.com";

    // Replace with your own project number from console.developers.google.com.
    // See "Project number" under "IAM & Admin" > "Settings"
    var appId = "517220932654";

    // Scope to use to access user's Drive items.
    var scope = ['https://www.googleapis.com/auth/drive.file profile email'];

    var pickerApiLoaded = false;
    var oauthToken;

    // Use the Google API Loader script to load the google.picker script.
    b.Upload = function() {
	if (pickerApiLoaded == false){
      gapi.load('auth', {'callback': b.onAuthApiLoad});
      gapi.load('picker', {'callback': b.onPickerApiLoad});
    }else{b.onPickerApiLoad()}}
	
    b.onAuthApiLoad = function() {
        window.gapi.auth.authorize(
          {
            'client_id': clientId,
            'scope': scope,
            'immediate': false
			
          },
          b.handleAuthResult);
    };


    b.onPickerApiLoad = function() {
      pickerApiLoaded = true;
      b.createPicker();
    };

    b.handleAuthResult = function(authResult) {
      if (authResult && !authResult.error) {
        oauthToken = authResult.access_token;
        b.createPicker();
      }
    };

    // Create and render a Picker object for searching files.
    b.createPicker = function() {
      if (pickerApiLoaded && oauthToken) {
		
        var docsView = new google.picker.DocsUploadView()
          .setIncludeFolders(true);
		
        var picker = new google.picker.PickerBuilder()
            .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
            .setAppId(appId)
            .setOAuthToken(oauthToken)
            .addView(docsView)
			.setCallback(b.uploadCallback)
            .setDeveloperKey(developerKey)
            .build();
         picker.setVisible(true);
      }
    };

    // A simple callback implementation.
    b.uploadCallback = function(data) {
      if (data.action == google.picker.Action.PICKED) {
        var fileId = data.docs[0].id;
		var param = {oAuthTokenup: oauthToken};
        alert('Successfully Uploaded!');
		$.ajax({
            url: '../code.php',
            type: "POST",
            data: param,
        });
		
	
	  }
	  
	};
	
	
	
})(upload);




