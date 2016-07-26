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
						
						$(".speak2").text(" ");
						move(final_transcript);

					};				
					recognition.start();
				}
				var stage;
					
				if(!(stage >= 1)){
					stage = 1;
				}
				
				function move(direction) {
					if(stage <= 7)
						$(".speak2").text(direction);
					else{
						if((direction.indexOf("go to website") !== -1) || (direction.indexOf("enter website") !== -1) || (direction.indexOf("enter the website") !== -1) || (direction.indexOf("enter") !== -1) )
						{
							$(".speak2").text(direction);
							window.location = "login.php";	
						}
						else{
							$(".speak2").html("<font style='color:rgb(201, 201, 201);'>"+direction+"</font>");
						}
					}
						
				//	$("div.container").append(" <span id='speak1' class='speak2'>"+direction+"</span>");
					if(!(direction == '')){
						speak(stage++, direction);
					}	
					//setTimeout(3000);
				}
				
				function speak(var1, direction) {
					/*if(var1 == 6 && ((direction.indexOf("yes") !== -1) || (direction.indexOf("yeah") !== -1) || (direction.indexOf("okay") !== -1) || (direction.indexOf("sure") !== -1) || (direction.indexOf("tell") !== -1) || (direction.indexOf("go ahead") !== -1) ))
					{
							
					}*/
					switch (var1) {
						case 1:
								var audio_duration = document.getElementById("sound1").duration;
								$(".speak1").text("Welcome to ATM++. Please say something to check your microphone.");
								document.getElementById("sound1").play();
								break;	
								//setTimeout(1000); 
						case 2:		
								
								var audio_duration = document.getElementById("sound2").duration;
								$(".speak1").text("Thank You! What is your name?");
								document.getElementById("sound2").play();
							break;		
						case 3:
								//var audio_duration = document.getElementById("sound3").duration;
								$(".speak1").text("How are you "+direction+"?");
								//document.getElementById("sound3").play();
								$.playSound('https://translate.google.com/translate_tts?tl=en&q=How%20are%20you%20'+direction+'?');
							break;	
						case 4:
								var mood;
								if((direction.indexOf("not happy") !== -1) || (direction.indexOf("not good") !== -1) || (direction.indexOf("not fine") !== -1) || (direction.indexOf("not okay") !== -1) || (direction.indexOf("not well") !== -1) || (direction.indexOf("sad") !== -1))
									mood = "sad";
								else
									mood = "happy";	
								
								if(mood == "happy")	
								{
									$(".speak1").text("Oh Great!!!");
									document.getElementById("sound4_1").play();
								}
								else
								{
									$(".speak1").text("Ohh... I am sorry.");
									document.getElementById("sound4_2").play();
								}
									//var audio_duration = document.getElementById("sound4").duration;
								//$(".speak1").text("How are you?");
								//document.getElementById("sound4").play();
							break;	
						case 5:
								var audio_duration = document.getElementById("sound5").duration;
								$(".speak1").text("Now, would you like to know more about ATM++?");
								document.getElementById("sound5").play();
							break;
						case 6:
								if((direction.indexOf("yes") !== -1) || (direction.indexOf("yeah") !== -1) || (direction.indexOf("okay") !== -1) || (direction.indexOf("sure") !== -1) || (direction.indexOf("tell") !== -1) || (direction.indexOf("go ahead") !== -1) )
								{
									var audio_duration = document.getElementById("sound6_1").duration;
									$(".speak1").text("ATM++ is a voice user interface based online ATM service. It provides you a user friendly interface which you can control through your voice. Now would you like to enter the website?");
									document.getElementById("sound6_1").play();		
								}
								else
								{
									var audio_duration = document.getElementById("sound6_2").duration;
									$(".speak1").text("Okay. Now would you like to enter the website?");
									document.getElementById("sound6_2").play();	
								}
								
							break;	
						case 7:
								if((direction.indexOf("yes") !== -1) || (direction.indexOf("yeah") !== -1) || (direction.indexOf("okay") !== -1) || (direction.indexOf("sure") !== -1) || (direction.indexOf("tell") !== -1) || (direction.indexOf("go ahead") !== -1) )
								{
									window.location = "<?php echo base_url(); ?>auth/login";	
								}
								else
								{
									var audio_duration = document.getElementById("sound7").duration;
									$(".speak1").html("Please <a href='<?php echo base_url(); ?>auth/login'>click here</a> to enter the website. <span style='float:right;margin-top:20px;font-size:11px;color:#e2e2e2;'> or say 'Enter the website'.</span>");
									document.getElementById("sound7").play();	
								}
							break;
								
					}
					
					//setTimeout(3000);
				}

			});
		</script>
	</head>
	<!--<body onLoad="checkSpeechSupport()"> -->
	<body>
		<div class="not-supported">
		  Your browser doesn't support Web Speech API. Please use Google Chrome.
		</div>		
		 <div class="supported"> 
				<div class="container">
					<!--<header>
						<h1>ATM++ <span>A VUI based banking solution | 24x7 At your service </span></h1>
					</header> -->
					<header class="header-box">
						<div class="content">
							<h1>Welcome to ATM++</h1>
						</div>
					</header>
					<div class="main clearfix">
						<img src="<?php echo base_url(); ?>img/atm.png" style="float:left;display:inline;"/>
						<span id="speak1" class="speak1">
							Why not test your microphone?
						</span>
						<img src="<?php echo base_url(); ?>img/user.png" style="float:right;display:inline;width:200px;height:auto;"/>
						<span id="speak1" class="speak2">...</span>
						
						<audio id="sound1" autobuffer src="<?php echo base_url(); ?>audio/1.mp3"></audio>
						<audio id="sound2" autobuffer src="<?php echo base_url(); ?>audio/2.mp3"></audio>
						<audio id="sound4_1" autobuffer src="<?php echo base_url(); ?>audio/4_1.mp3"></audio> 
						<audio id="sound4_2" autobuffer src="<?php echo base_url(); ?>audio/4_2.mp3"></audio> 
						<audio id="sound5" autobuffer src="<?php echo base_url(); ?>audio/5.mp3"></audio> 
						<audio id="sound6_1" autobuffer src="<?php echo base_url(); ?>audio/6_1.mp3"></audio> 
						<audio id="sound6_2" autobuffer src="<?php echo base_url(); ?>audio/6_2.mp3"></audio> 
						<audio id="sound7" autobuffer src="<?php echo base_url(); ?>audio/7.mp3"></audio> 
					</div>
					<!--
					<object type="application/x-shockwave-flash" id="VHSS" data="http://content.oddcast.com/vhss/vhss_v5.swf?doc=http%3A%2F%2Fvhss-d.oddcast.com%2Fphp%2FplayScene%2Facc%3D15679%2Fss%3D232774%2Fsl%3D0&amp;acc=15679&amp;bgcolor=0xFFFFFF&amp;pageDomain=www.oddcast.com&amp;lc_name=1373415208&amp;fv=9&amp;is_ie=0&amp;followCursor=1&amp;emb=8&amp;embedid=aeb9df55bf09a7c61267b50333d5f5d2" width="400" height="300"><param name="scale" value="noborder"><param name="bgcolor" value="FFFFFF"><param name="quality" value="high"><param name="name" value="VHSS"><param name="allowscriptaccess" value="always"><param name="swliveconnect" value="true"></object>
					-->
				</div>	
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