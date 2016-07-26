<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>ATM++</title>
		<meta name="robots" content="noindex, nofollow" />
		<meta name="description" content="ATM++" />
		<meta name="keywords" content="ATM++" />
		<meta name="author" content="<?= STUDENT;?>" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/component.css" />
		 <script src="<?php echo base_url(); ?>js/libs/jquery-1.7.1.min.js"></script> 
		<script src="<?php echo base_url(); ?>js/jquery.playSound.js"></script>  
		<!--<script src="<?php echo base_url(); ?>js/myscript1.js"></script> -->
		<script src="<?php echo base_url(); ?>js/myscript2.js"></script>
		<script src="<?php echo base_url(); ?>js/modernizr.custom.js"></script>
		<script>
			$(document).ready(function() {

				if (!('webkitSpeechRecognition' in window)) {

					$('.not-supported').show();
					$('.supported').hide();

				} else {
					
					document.getElementById("sound1").play();	
					
					$('.not-supported').hide();

					var recognition = new webkitSpeechRecognition();
						recognition.continuous = true;
						recognition.interimResults = true;

					recognition.onresult = function(event) {
						final_transcript = '';
						var interim_transcript = '';

						for (var i = event.resultIndex; i < event.results.length; ++i) {
							if (event.results[i].isFinal) {
								final_transcript += event.results[i][0].transcript;
							} else {
								interim_transcript += event.results[i][0].transcript;
							}
						}

						move(final_transcript);

					};

					recognition.start();


				}
				/*
				var width = $(document).width(),
					height = $(document).height();

				$('#box').css({ left: width / 2 -  25});
				*/

				levenshteinLevel = false;

				$('#level').change( function () {
					levenshteinLevel = $(this).val();
				});

				function move(direction) {

					var animationTime = 2000,
						directions = ["more info","info","information","more information","close","back","go back","submit"];
					direction = direction.replace(/\W/g, "");
					if (direction === "") {
						return;
					}

				//   $('<span />').html(direction).appendTo('#commands');
				
					$("#speak1").text(direction);
					
					if (levenshteinLevel) {
						for (var i = 0; i < directions.length; i++) {
							if (levenshtein(directions[i], direction) <= levenshteinLevel) {
								direction = directions[i];
								break;
							}
						}
					}

				//    $('#directions div').removeClass('directionActive');
				//    $('#' + direction).addClass('directionActive');

					switch (direction) {
					
					case 'submit':
						$("#form").submit();	
						break;	
					case 'back':
					case 'close':
						$("#back").click();	
						break;	
					case 'information':
					case 'about':
					case 'what is this':
						$("#more-info").click();	
						break;
					case 'username':
					case 'input username':
						$('#username').focus();
						break;	
					case 'password':
					case 'input password':
						$('#password').focus();
						break;		
					case 'next':
						if ($("input#username").is(":focus")) {
							$('#more-info').focus();
							$('#password').focus();
						}
						if ($("input#password").is(":focus")) {
							$('#submit').focus();
						}
						break;		
					}
					
					if ($("input#username").is(":focus")) {
					  $("input#username").val(direction);
					}
					if ($("input#password").is(":focus")) {
					  $("input#password").val(direction);
					}
					
				}

			});
		</script>
		<script>
			function validateForm()
			{
			var x=document.forms["form"]["username"].value;
			if (x==null || x=="")
			  {
				  alert("Please enter the username");
				  return false;
			  }
			  
			var y=document.forms["form"]["password"].value;
			if (y==null || y=="")
			  {
				  alert("Please enter the password");
				  return false;
			  }
			}
		</script>
	</head>
	<!--<body onLoad="checkSpeechSupport()"> -->
	<body>
	<div class="not-supported">
	  Your browser doesn't support Web Speech API. Please use Google Chrome.
	</div>

		<div class="md-modal md-effect-11" id="modal-11">
			<div class="md-content">
				<h3>About ATM++</h3>
				<div>
					<p style="text-align:center;">A VUI based banking solution</p>
					<ul>
						<li><strong>About:</strong> Our online ATM++ portal provides personal banking services online.</li>
						<li><strong>Project:</strong> ATM++</li>
						<li><strong>Developed by:</strong> <?= STUDENT;?></li>
						<!--<li><strong>Extra:</strong> Isn't it interesting that you can close this popup by saying "<b>Close</b>" or "<b>Back</b>"</li> -->
					</ul>
					<br/>
					<p style="text-align:center;">Isn't it interesting that you can close this popup by saying <br/>"<b>Close</b>" or "<b>Back</b>"</p>
					<br/>
					<button id="back" class="md-close btn-1">Close me!</button>
				</div>
			</div>
		</div>
		
		 <div class="supported"> 
				<div id="top">
					<div class="container">
						<!--<span>Developed By: <?= STUDENT;?></span> -->
					</div>
				</div>

				<div class="container">
					<header>
						<h1>ATM++ <span>A VUI based banking solution | 24x7 At your service </span></h1>
					</header>
					<div class="main clearfix">
						<div class="column">
							<p style="font-size:29px;text-align:left;display:block;">
								Browse this portal with your voice
								<br/>
								<span id="speak1" style="font-size:20px;">Your Voice Commands</span>
							</p>	
							<p style="font-size:29px;text-align:left;display:block;margin-top:20px;">
								Our online ATM++ portal provides personal banking services online
							</p>
							<br/>
							<!--
							<div id="levenshtein">
								threshold level<br />
								<input id="level" type="range" min="0" max="5" step= "1" value="0" />
							</div> -->
							<button id="more-info"  class="btn-1 md-trigger md-setperspective" data-modal="modal-11" style="font-size:20px;">What Is ATM++ ??</button>
							
						</div>
						<div class="login">
							<form id="form" method="post" action="<?php echo base_url(); ?>verifylogin" onsubmit="return validateForm()">
								<h1>Sign In</h1>
								<div>
									<input x-webkit-speech onwebkitspeechchange="checkanswer()" name="username" type="text" placeholder="Username" required="" id="username" />
								</div>
								<div>
									<input x-webkit-speech onwebkitspeechchange="checkanswer()" name="password" type="password" placeholder="Password" required="" id="password" />
								</div>
								<div style="padding: 7px 10px 0px 40px;width: 70%;">
									<button id="submit" type="submit" value="Log in" />Submit</button>
								</div>
							</form>
							<br/>
							
						</div>
						
						<!--
						<div class="fullwidth">
							<p style="font-size:29px;text-align:left;">
								You can browse this portal with your voice &nbsp;&nbsp;&nbsp; <span id="speak1" style="font-size:20px;">More Info</span>
							</p>	
						</div>-->
					</div>
				</div><!-- /container -->
				<footer>
					<div class="container">
						<span>Developed By: <?= STUDENT;?> &nbsp;&nbsp; | &nbsp;&nbsp; All Rights Reserved</span>
					</div>
				</footer>
				
				<audio id="sound1" autobuffer src="<?php echo base_url(); ?>audio/login/1.mp3"></audio>
		</div>
		<div class="md-overlay"></div><!-- the overlay element -->

		<!-- classie.js -->
		<script src="<?php echo base_url(); ?>js/classie.js"></script>
		<script src="<?php echo base_url(); ?>js/modalEffects.js"></script>

		<!-- for the blur effect -->
		<script>
			// this is important for IEs
			var polyfilter_scriptpath = '/js/';
		</script>
	<!--	<script src="js/cssParser.js"></script>
		<script src="js/css-filters-polyfill.js"></script> -->
	</body>
</html>