
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>My AUB Advisor</title>
        <link href="css/bootstrap-combined.min.css" rel="stylesheet">
        
        <!-- CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/styles.css" rel="stylesheet">
		<script src="js/main.js"></script>
	<script src="js/ajax.js"></script>
	<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <!--<script src="js/script.js"></script>-->
   <title>CSS MenuMaker</title>
	<script>
	function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
	rx = /[' "]/gi;
	} else if(elem == "username"){
	rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
	}
	function emptyElement(x){
	_(x).innerHTML = "";
	}
	function checkusername(){

	var username = _("username").value;
		if(username != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
			ajax.onreadystatechange = function() {
			   if(ajaxReturn(ajax) == true) {
			   _("unamestatus").innerHTML = ajax.responseText;
			   }
			}
			ajax.send("usernamecheck="+username);
		}
	}
	function login(){
	var password = _("password").value;
	var username = _("email").value;
		if(username != ""){
		_("loginstatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "personal.php");
			ajax.onreadystatechange = function() {
			   if(ajaxReturn(ajax) == true) {
				   if (parseInt(ajax.responseText) == 0) {
			   _("loginstatus").innerHTML = ajax.responseText.substring(1);
			   $('#loginform')[0].reset();
			   }
			   else {
				   _("senduser").value = ajax.responseText ; 
				   //window.open(ajax.responseText , "_self");
				   _("personalthing").submit() ; 
				   
			   }
			}
			}
			ajax.send("username="+username+"&password="+password);
		}
	}
	function signup(){
		var u = _("username").value;
		var n=_("name").value;
		var m=_("major").value;
		var e = u+"@mail.aub.edu";
		var p1 = _("pass1").value;
		var p2 = _("pass2").value;
		var english = _("english").value;
		var arabic = 0 ;
		if (document.getElementById("arabic").checked == true) {
			//alert (11) ;
			arabic = 1 ;
		}

		if(u == "" || e == "" || p1 == "" || p2 == "" || n == "" || m == ""){
		_("status").innerHTML = "Fill out all of the form data";
		} else if(p1 != p2){
		_("status").innerHTML = "Your password fields do not match";
		}  else {
		_("signupbtn").style.display = "none";
		_("status").innerHTML = 'please wait ...';
		//alert (3) ;
		if (/^[A-Z-a-z]{3}\[0-9]{2}$/.test(u) ) {
		//	alert (2) ;
		var ajax = ajaxObj("POST", "completesignup.php");
			ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				console.log((ajax.responseText).trim());
				if((ajax.responseText).trim() != "signup_success"){
				alert ("Username is taken") ;
				_("signupbtn").style.display = "block";
				_("status").innerHTML = '';
				$('#signupform')[0].reset();
				_("unamestatus").innerHTML = '' ;
			   }
			else{
						window.scrollTo(0,0);
						alert ( "You can now check your email inbox and junk mail box at your aub email address in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account." );
					_("signupbtn").style.display = "block";
					_("status").innerHTML = '';
					$('#signupform')[0].reset();
					_("unamestatus").innerHTML = '' ;
					}
				}
			}
			ajax.send("u="+u+"&n="+n+"&p="+p1+"&m="+m+"&e="+e+"&english="+ english + "&arabic=" + arabic );
		}
		else {
			alert ("Come on its a wrong username !!!") ;
					_("signupbtn").style.display = "block";
					_("status").innerHTML = '';
					$('#signupform')[0].reset();
					_("unamestatus").innerHTML = '' ;
		}
		}
	}
	
	
	</script>
    </head>
    
    <!-- HTML code -->
    
<body>
<form id="personalthing" action="ang5.php" method="POST"  style="display:none">
  <input id ="senduser" type="text" name="fname">

</form>

<!--<div class="container navbar-wrapper" >
        <div class="navbar navbar-inverse">
          <div class="navbar-inner" style = "padding : 0px ;">
<div id='cssmenu'>
<ul>
   <li class="active brand"><a href="#">MyAUBAdvisor</a></li>
   <li><a href='#'>Products</a></li>
   <li><a href='#'>Company</a></li>
   <li><a href='#'>Contact</a></li>
</ul>
</div>
</div>
</div>
</div> -->
        <!-- NAVBAR
    =================== -->
	
<div class="navbar-wrapper" style = "position : fixed ;">
      <div class="container" >

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">

            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">MyAUBAdvisor</a>
            <div class="nav-collapse collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="contactus.html">Contact</a></li>
        <li class="dropdown">
        <a  href = "#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
        <div class="dropdown-menu" style= "padding-left : 10px ;">
		
			<form id="loginform" name="loginform" class="navbar-form" role="form" onsubmit="return false;" >
				<div class="formMember">Email Address:
				<input type="text" id="email" onfocus="emptyElement('status')" maxlength="88"></div>
				
				<div class="formMember">Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="password" id="password" onfocus="emptyElement('status')" maxlength="100"></div>
				<p id="loginstatus"></p>
				<br />
				<button class="btn" onclick="login()">Log In</button>

            </form>
        </div>
    </li>
                </ul>
            </div>
          </div>
        </div>

      </div>
    </div>



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="pics/aub.jpg">
          <div class="container">
            <div class="carousel-caption">
              <h1>Register Now</h1>
              <p class="lead">The easiest way to plan your stay at AUB</p>
              <a class="btn btn-large btn-primary" href="#" data-toggle="modal" data-target="#t_and_c_m">Sign Up Today!</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="pics/afootball.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>American Football team</h1>
              <p class="lead">Our Boys enjoying the weather </p>
              <a class="btn btn-large btn-primary" href="#">Learn more</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="pics/last.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Helping you graduate since 2015!</h1>
           <!--   <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>-->
              <a class="btn btn-large btn-primary" href="#">Browse gallery</a>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="span4">
          <img class="img-circle" data-src="http://placehold.it/140/">
          <h2>Welcome to AUB Advisor</h2>
          <p>AUB Advisor is here to help students stay up to date with changes in the university which are relevant to their major.
			It will be easy to navigate and make university changes public, thus clear to students. AUB Advisor is a platform that will help ensure that 
			students don't miss graduation because of a single missing course.</p>
          <p><a class="btn" href="#">View details »</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img-circle" data-src="http://placehold.it/140/">
          <h2>Don't Forget!</h2>
          <p> All graduates who would like to take their Year Book photo must pass by West Hall this week! The photoshoot will take place between Monday and Friday, 10:00AM-6:00PM.</p>
          <p><a class="btn" href="#">View details »</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img-circle" data-src="http://placehold.it/140/">
          <h2>Sports</h2>
          <p>Congratulations to the Varsity Football Boys team! They beat USJ with a score of 3-1.</p>
          <p><a class="btn" href="#">View details »</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->
<!--
      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image pull-right" src="pics/chrome.png">
        <h2 class="featurette-heading">First featurette headling. <span class="muted">It'll blow your mind.</span></h2>
        <p class="lead">Google Chrome is a freeware web browser developed by Google. It used the WebKit layout engine until version 27 and, with the exception of its iOS releases, from version 28 and beyond uses the WebKit fork Blink.It was first released as a beta version for Microsoft Windows on September 2, 2008, and as a stable public release on December 11, 2008.</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image pull-left" src="pics/firefox.jpg">
        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="muted">See for yourself.</span></h2>
        <p class="lead">Firefox was named the ”speed king” in independent benchmark and performance tests against other browsers. Save time and do just about anything quicker than before.</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image pull-right" src="pics/Safari.png">
        <h2 class="featurette-heading">And lastly, this one. <span class="muted">Checkmate.</span></h2>
        <p class="lead">Safari is a web browser developed by Apple Inc. included with the OS X and iOS operating systems. First released as a public beta on January 7, 2003,[3] on the company's OS X operating system, it became Apple's default browser beginning with Mac OS X v10.3 "Panther". The native browser of iOS is also called Safari, but has a different graphical user interface (GUI) and uses a different WebKit version and application programming interface (API)</p>
      </div>

      <hr class="featurette-divider">
-->
<!-- Modal -->

<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9998;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Sign Up</h4>
			</div>
			<div class="modal-body">
			<h2>Please Sign Up <small>It's free and always will be.</small></h2>
			<hr class="colorgraph">
				<div id="signupDiv">
				<form name="signupform" id="signupform" onsubmit="return false;" style = "padding-left : 10px;">
					</br>
					
					<div> Name: </div>
					<input id="name" type="text"></br></br>
					
					<div>AUB Email: </div>
					<input  id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16"></br>
					<span id="unamestatus"> </span></br></br>
					
					<div>Major: </div>
					<select  id="major">
					   <option value="cmps">Computer Science</option>
					   <option value="math">Math</option>					
					</select>
					</br></br>
					
					<input id = "arabic" type="checkbox" name="arabic" > I am exempted from arabic<br>
					</br></br>
					<div>First English Course: </div>
					<select  id="english">
					   <option value="-1">English 102</option>
					   <option value="0">English 203</option>
                       <option value="1">English 204</option>					   
					</select>
					</br></br>
					
					<div>Create Password:</div>
					<input  id="pass1" type="password" onfocus="emptyElement('status')" maxlength="16"></br></br>
					
					<div>Confirm Password:</div>
					<input  id="pass2" type="password" onfocus="emptyElement('status')" maxlength="16"></br></br>

					<br />
					<button id="signupbtn" onclick="signup()">Create Account</button>
					<span id="status"></span>
				</form>
			</div>
			
			<hr class="colorgraph">


			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
</div>

<div>
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>© AubAdvisor Team <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->
        
        <script type='text/javascript' src="js/jquery.min.js"></script>


        <script type='text/javascript' src="js/bootstrap.min.js"></script>


        <script type='text/javascript' src="js/angular.min.js"></script>


        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
    </body>
</html>