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
				$('#go-back').click(function() {
				   window.location = "<?php echo base_url(); ?>main/transaction";
				});
				$('#logout').click(function() {
				   window.location = "<?php echo base_url(); ?>main/logout";
				});
			});	
		</script>
		<script>
			$(document).ready(function() {

				if (!('webkitSpeechRecognition' in window)) {

					$('.not-supported').show();
					$('.supported').hide();

				} else {
					
					$('.not-supported').hide();

					//document.getElementById("sound1").play();	
					
					//$.playSound('https://translate.google.com/translate_tts?tl=en&q=You%20have%20ten%thousand%20rupees%in%your%account');
					
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
					
					case 'logout':
					case 'log out':
						$("#logout").click();	
						break;	
					case 'back':
					case 'go back':
					case 'goback':
						$("#go-back").click();	
						break;	
					}
				}

			});
		</script>
	</head>
	<body>
		<div class="not-supported">
		  Your browser doesn't support Web Speech API. Please use Google Chrome.
		</div>
		<div class="supported"> 
			<div class="container">
				<header class="header-box">
					<div class="content">
						<h1>Balance Enquiry</h1>
					</div>
				</header>
				<div class="main clearfix">
					<div class="column">
						<p style="font-size:29px;text-align:left;display:block;margin-top:20px;">
							<span style="width:100%;text-aligh:center;font-size:35px;margin-left:20px;">Welcome <?php echo $name; ?></span>
						</p>
						<br/>
						<img class="profile-pic" src="<?php echo base_url(); ?>img/profiles/<?php echo $profile_image; ?>"/>
						<button class="btn-big" id="logout" style="font-size:20px;">Logout</button>
						<p style="font-size:29px;text-align:left;display:block;">
							<br/><br/>
							Browse this portal with your voice
							<br/>
							<span id="speak1" style="font-size:20px;">Your Voice Commands</span>
						</p>
					</div>
					<div class="column">
						<p style="font-size:29px;text-align:left;display:block;margin-top:20px;">
							<span style="width:100%;text-aligh:center;font-size:35px;margin-left:20px;">Balance Enquiry</span>
							<br/>
							<span style="width:100%;text-aligh:center;font-size:35px;margin-left:20px;">Account Balance: <?php echo $account_balance; ?> NGN</span>
							<br/>
							<span style="width:100%;text-aligh:center;font-size:35px;margin-left:20px;">Thanks for using our services</span>
						</p>
						<button class="btn-big" id="go-back" style="font-size:20px;float:left;width:auto;height:auto;margin:15px;padding-top:1.8em;padding-bottom:1.8em;">Go Back</button>
						<audio id="beep-two" controls preload="auto">
							<source src="<?php echo base_url(); ?>audio/beep.mp3" controls></source>
							<source src="<?php echo base_url(); ?>audio/beep.ogg" controls></source>
						<!--	Your browser isn't invited for super fun time. -->
						</audio>
						
					</div>
					<script>
						$(".btn-big")
						  .each(function(i) {
							if (i != 0) { 
							  $("#beep-two")
								.clone()
								.attr("id", "beep-two" + i)
								.appendTo($(this).parent()); 
							}
							$(this).data("beeper", i);
						  })
						  .mouseenter(function() {
							$("#beep-two" + $(this).data("beeper"))[0].play();
						  });
						$("#beep-two").attr("id", "beep-two0");
					</script>
				</div>
			</div>
		<div class="supported"> 	
			<script>
				$.playSound('http://translate.google.com/translate_tts?tl=en&q=you%20have%20,<?php echo $account_balance; ?>%20rupees%20in%20your%20account');
			</script>
		<!--<audio id="sound1" autobuffer src="<?php echo base_url(); ?>audio/login/5.mp3"></audio>-->
	<!--	<audio id="sound1" autobuffer preload="auto" src="https://translate.google.com/translate_tts?tl=en&q=You%20have%20ten%thousand%20rupees%in%your%account"></audio> -->
		
		<div class="md-overlay"></div><!-- the overlay element -->

		<!-- classie.js -->
		<script src="<?php echo base_url(); ?>js/classie.js"></script>
		<script src="<?php echo base_url(); ?>js/modalEffects.js"></script>

		<!-- for the blur effect -->
		<script>
			// this is important for IEs
			var polyfilter_scriptpath = '/js/';
		</script>
	<!--	<script src="<?php echo base_url(); ?>js/cssParser.js"></script>
		<script src="<?php echo base_url(); ?>js/css-filters-polyfill.js"></script> -->
	</body>
</html>