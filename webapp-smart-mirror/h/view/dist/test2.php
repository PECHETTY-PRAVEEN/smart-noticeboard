<html lang="en"><head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>

   
<!-- bootstrap styles -->
<link rel="shortcut icon" href="//app.3rdflix.com/v1/styles/images/favicon.png">
<link href="//app.3rdflix.com/v1/styles/bootstrap.css" rel="stylesheet">
<!--<link href="styles/bootstrap-theme.css" rel="stylesheet" />
-->
<!-- Custom theme -->
<link href="//app.3rdflix.com/v1/styles/corsalite.css" rel="stylesheet">
<link href="//app.3rdflix.com/v1/styles/dailog.css" rel="stylesheet">
<!-- Font Icons -->
<link href="//app.3rdflix.com/v1/styles/font-awesome.css" rel="stylesheet">



<!--[if lt IE 9]>  
    <script src="//app.3rdflix.com/v1//js/html5shiv.js"></script>
    <script src="//app.3rdflix.com/v1//js/respond.js"></script>
<![endif]-->

</head>
<body class="login"><div class="container margin-top">
		<div class="col-md-3 col-xs-12">
			<div class="entityLogo"></div>
		</div>
		<div class="col-md-3 col-xs-12 pull-right hidden-xs">
			<div class="brandLogo"></div>
		</div>
	</div>
		<style>
			body.login{background:url('http://app.corsalite.com/v1/styles/images/3rdFlix grey Bg.png') no-repeat center bottom #000000 !important;background-size:600px 600px !important;}.login .dialog .inlineBlock .dlg-head{background:#898989;}.login .btn-success{color:#fff;background-color:#898989;border-color:#898989;}			@media only screen and (max-width: 767px) {
				.login .PFix .inlineBlock{position:relative !important;left:0%;}body.login{background-size:100% 100% !important;}			}
		</style>

	
    <div class="main-wrap">
    
      <div class="dialog">
        <div class="PFix">
		
          <div class="PFixWrap">
		              <div class="inlineBlock">
			                <form role="form" action="//app.3rdflix.com/v1/login/verifyUsers" method="post" id="loginForm">
			  
                <h3 class="dlg-head">Login </h3>
                <div class="dialog-content">
                                  <div style="color: red; text-align:center;" id="userlogmsg">
                                </div>
				
				  				
                  <div class="form-group">
                    <label for="username">Login ID</label>
                    <input id="email" type="text" class="form-control" name="email" value="" tabindex="1">
                    <label class="error"></label>
                  </div>
                  <div class="form-group">
                    <label for="password">Password <a href="//app.3rdflix.com/v1/login/forgotPassword" title="Forgot Password?"><i class="fa fa-question-circle"></i></a></label>
                    <input id="password" type="password" class="form-control" name="password" value="" tabindex="2">
                    <label class="error"></label>
                  </div>
                                    <input type="hidden" name="captcha" value="1">
                                   <div class="form-group row">
                  <div class="col-sm-12 nopad btns text-center">
                   
                     <button type="button" class="btn btn-success" tabindex="3" onclick="return checkLoggedIn();">Login</button>
                    <!-- <a class="btn btn-facebook" href="https://www.facebook.com/dialog/oauth?client_id=466979580131618&redirect_uri=http%3A%2F%2Fapp.corsalite.com%2Fstagenewchanges%2Flogin&state=34149414cdbeb36cb97324ab037783c6&sdk=php-sdk-3.2.3&scope=email"><i class="fa fa-facebook"></i> Login with Facebook</a> -->
                  <!--  onclick="return checkLoggedInWebsocket();"-->
                    <!-- <a href="//app.3rdflix.com/v1/registration" class="btn btn-success" type="submit">Register</a>-->
                    </div>
                    
                 
                  </div>
                  
                </div>
              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>
	<div class="col-md-3 col-xs-12 pull-right visible-xs">
		<div class="brandLogo"></div>
	</div>
	
	
 
<script src="//app.3rdflix.com/v1/js/jquery-1.11.0.min.js"></script>
<!-- bootstrap js -->
<script src="//app.3rdflix.com/v1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
	$("#RankListModal").modal('show');
	// Tooltip
	$('[data-original-title]').tooltip({container:'body'});

	$('.alert').fadeIn("100").delay("2500").fadeOut("100");
})
</script>

<script src="//app.3rdflix.com/v1/js/fancywebsocket.js"></script>
<script type="text/javascript">
 
function checkLoggedIn() {
	if($('#email').val() != '' && $('#password').val() != '') {
		var checkloginform = 1;
		 $.ajax({
			type: "POST",
			url: "//app.3rdflix.com/v1/login/ajaxVerifyUser",
			data: "email="+$('#email').val()+"&password="+$('#password').val(),
			async:false,
		
		})
		 .success(function( result ) {
  			 if(result == 1) {
				 //$('#userlogmsg').html('You are already logged in through another device. Please log out and try again.');
				 checkloginform = 0; 
			 }
			 else {
				 $('#userlogmsg').html(''); 
				 checkloginform = 1;
			 }
			 
		});	 
	}
	else {
		checkloginform = 0;
		if($('#email').val() == '') {
			$('#email').next('.error').html('The Email field is required.');
		}else
			$('#email').next('.error').html('');
		 if($('#password').val() == '') {
			$('#password').next('.error').html('The Password field is required.');
		}else 
			$('#password').next('.error').html('');
			
		if($('#email').val() == '' && $('#password').val() == ''){
			$('#email').next('.error').html('The Email field is required.');
			$('#password').next('.error').html('The Password field is required.');
		}
		
		return false;
	}
 	checkLoginMessage(checkloginform); 
}

function checkLoginMessage(checklform) {
	console.log(checklform);
	 
   	if(checklform) {
  			  $('#loginForm').submit();
			  return true;
		}
		else { 
			if(confirm('You are already logged in through another device. Proceed to Close the Session?')) {
				$('#loginForm').append('<input type="hidden" name="closeprevsession" value="1" id="closeprevsession" />');
				  $('#loginForm').submit();
			}
			else
				return false;
 		}
}
var Server;

function log( text ) {
			//$log = $('#log');
			//Add text to log
		//	$log.append(($log.val()?"\n":'')+text);
			//Autoscroll
		//	$log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
		}

		function send( text ) {
			//alert(text);
			Server.send( 'message', text );
		}


$(document).ready(function () {
 Server = new FancyWebSocket('wss://websocket.corsalite.com:9300/');
 //Let the user know we're connected
Server.bind('open', function() {
	//alert("hai");
send('{"event":"logout"}');
});
try {
	Server.connect();
}
catch(e){
	console.log("Websocket connection error wss://websocket.corsalite.com:9300/");
} 
});

  
function checkLoggedInWebsocket() {
	 $('#userlogmsg').html('');
	if($('#email').val() != '' && $('#password').val() != '') {
	 var idstudent = 0;
	 var usertype = '';
	 
	 $.ajax({
		type: "POST",
		url: "//app.3rdflix.com/v1/login/ajaxVerifyUser",
		data: "email="+$('#email').val()+"&password="+$('#password').val(),
		async:false,
	
	})
	 .success(function( userData ) {
		 
		 var obj = jQuery.parseJSON(userData);
  		 if(obj.returnmsg == 0 && obj.userType == 'Student') {
			 
			 if(obj.idStudent != '')
				 idstudent = obj.idStudent; 
			 usertype = obj.userType; 
		 	}
			 else {
				 $('#loginForm').attr('action',"//app.3rdflix.com/v1/login/verifyUsers");
			 	  $('#loginForm').submit();
			 }
	});	 
	console.log('Connecting...');
 	 var checkform = 1;
	Server = new FancyWebSocket('wss://websocket.corsalite.com:9300/');
	Server.bind('open', function() {
		send('{"event":"getuserslist", "idStudent":""}');						
		console.log( "open." );
	});			
	Server.bind('message', function( payload ) {
	 var jsonObject = JSON.parse(payload);
	 if(jsonObject.event && jsonObject.event=='Userslist')
	 {
			var users1 = jsonObject.Users;
			var ulist = users1.split(",");
			 console.log('stud'+idstudent);
			 console.log('olduserarr'+users1);
			 var newarr=[];
			
			$.each(ulist , function(i, val) {
				
				if(ulist[i] !== "" && ulist[i] !== null){
    				newarr.push(ulist[i]);
   				}  
			});
			  console.log('userarr'+newarr);
			  console.log('arraycheck'+$.inArray( idstudent, newarr ));
			 
			if($.inArray( idstudent, newarr ) !== -1 && usertype == 'Student') {
				
					 $('#userlogmsg').html('You are already logged in through another device. Please log out and try again.'); 
					 checkform = 0;
					 
		  }
		  else {
			 
			 checkform = 1;
		  }
	 }
	 
	checkMessage(checkform); 
	 });
	try {
		Server.connect();
	}
	catch(e){
		console.log("Websocket connection error wss://websocket.corsalite.com:9300/");
	}   
	 return false;
 		
	}
	else
		return true;
}

$('input[type=text],input[type=password]').on('keyup', function(e) {
  if (e.which == 13) {
    checkLoggedIn();
    return false;     
  }
});
function checkMessage(checkform) {
  	if(checkform) {
			 $('#loginForm').attr('action',"//app.3rdflix.com/v1/login/verifyUsers");
			  $('#loginForm').submit();
		}
		else { ;
			return false;
		}
}

 	 function changeHashOnLoad() {
		window.location.href += "#";
		setTimeout("changeHashAgain()", "50"); 
	}
	
	function changeHashAgain() {
		window.location.href += "1";
	}
	
	var storedHash = window.location.hash;
	window.setInterval(function () {
		if (window.location.hash != storedHash) {
			 window.location.hash = storedHash;
		}
	}, 50);
	changeHashOnLoad();

 
  </script>

<style>
.modal-dialog {
}
.modal-dialog img{
	width: 100%;	
}
.modal-content {
  height: auto;
  border-radius: 0;
}
.modal-header{
	padding: 0px;
	border-bottom: 0px;
}
.modal-body{
	padding: 0px;
	background: #0059a9;
}
.close{
	position: absolute;
    right: 0px;
    font-size: 40px;
    background: #e01f22 !important;
    opacity: 0.7;
    color: white;
}
.modal {
  text-align: center;
}
</style></body></html>