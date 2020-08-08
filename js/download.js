	var download = {};
	(function(a){
	var pickerApiLoaded = false;
	var oauthToken;
	
    a.onApiLoad = function(){
	if (pickerApiLoaded == false){
        gapi.load('auth',{'callback': a.onAuthApiLoad}); 
        gapi.load('picker', {'callback': a.onPickerApiLoad});
    }else{a.onPickerApiLoad()}}
	
    a.onAuthApiLoad = function(){
        window.gapi.auth.authorize({
            'client_id':'517220932654-28b347kp4ab63dt7do8amaqtat4in1os.apps.googleusercontent.com',
            'scope':['https://www.googleapis.com/auth/drive'],
            'immediate': false
        },a.handleAuthResult);
    } 
    a.onPickerApiLoad = function() {
                pickerApiLoaded = true;
                a.createPicker();
            }
    a.handleAuthResult = function(authResult){
        if(authResult && !authResult.error){
            oauthToken = authResult.access_token;
            a.createPicker();
        }
    }
    a.createPicker = function(){    
        if (pickerApiLoaded && oauthToken) {
		var docview = new google.picker.DocsView()
          .setIncludeFolders(true) 
		  .setOwnedByMe(true)
          .setSelectFolderEnabled(true);
		var view = new google.picker.View(google.picker.ViewId.DOCS);
        view.setMimeTypes("text/html");
        var picker = new google.picker.PickerBuilder()
            .addView(docview)
            .setOAuthToken(oauthToken)
            .setDeveloperKey('AIzaSyBtGkAnDdXzbjMCA7up9sEbq2nbOoEYxC8')
            .setCallback(a.pickerCallback)
            .build();
        picker.setVisible(true);
    }
}


    a.pickerCallback = function(data) {
                var url = 'nothing';
                var name = 'nothing';
                if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
                    var doc = data[google.picker.Response.DOCUMENTS][0];
                    url = doc[google.picker.Document.URL];
                    name = doc.name;
					Number.prototype.padLeft = function(base,chr){
					var  len = (String(base || 10).length - String(this).length)+1;
					return len > 0? new Array(len).join(chr || '0')+this : this;
					}
					var d = new Date,
					dformat = [
					d.getFullYear(),
					(d.getMonth()+1).padLeft(),
					d.getDate().padLeft()].join('-') +' ' +
					[d.getHours().padLeft(),
					d.getMinutes().padLeft(),
					d.getSeconds().padLeft()].join(':');
					var gparam = {download_count:"1", username:"rowen", image:"image.jpg", email:"haharowen@gmail.com", time:dformat};
                    var param = {'fileId': doc.id, 'oAuthToken': oauthToken, 'name': name}
                    console.log(param);
                    document.getElementById('result').innerHTML = "Downloading...";
                    $.post('../down.php', param,
                            function(returnedData) {
                                document.getElementById('result').innerHTML = "Download completed";
                            });
							$.ajax({
							url: 'https://gcloud-e4793.firebaseio.com/download.json',
							type: "POST",
							data: JSON.stringify(gparam),
							});
                            }
                        }
	})(download);