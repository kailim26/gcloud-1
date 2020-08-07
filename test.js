		function lol(){
		$.ajax({
          type: "POST",
          url: "../code.php",
          data: {"uploadpost":"uploadnum", "username":"username", "image":"image", "email":"email"},
          contentType: "application/json; charset=utf-8",
          dataType: "json"
		});
		};