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
		 <script src="<?php echo base_url(); ?>js/jquery.printElement.js"></script>  
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
				$('#print-statement').click(function() {
				   //$('#mini-statement-box').print();
				   $("#mini-statement-box").printElement({printMode:'popup'});
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
					
					document.getElementById("sound1").play();	
					
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

				
					$("#speak1").text(direction);
					
					if (levenshteinLevel) {
						for (var i = 0; i < directions.length; i++) {
							if (levenshtein(directions[i], direction) <= levenshteinLevel) {
								direction = directions[i];
								break;
							}
						}
					}


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
					case 'print statement':
					case 'printstatement':
					case 'print':
					case 'print mini statement':
					case 'print ministatement':
						$("#print-statement").click();	
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
						<h1>Mini Statement</h1>
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
							<span style="width:100%;text-aligh:center;font-size:35px;margin-left:20px;">Mini Statement</span>
							<div id="mini-statement-box" style="overflow:hidden;">
								<div style="float:left;width:100%;display;block;line-height:14px;padding:8px 0px 8px 0px;border-bottom:1px solid #e2e2e2;">
									<div style="width:100%;text-align:center;">ATM++ Mini Statement</div>
								</div>
								<div style="float:left;width:100%;display;block;line-height:14px;padding:8px 0px 8px 0px;border-bottom:1px solid #e2e2e2;">
									<div style="width:30%;float:left;margin-left:5%;text-align:center;">Time</div>
									<div style="width:25%;float:left;text-align:center;">Balance</div>
									<div style="width:20%;float:left;text-align:center;">Transaction</div>
									<div style="width:20%;float:left;text-align:center;">Type</div>
								</div>
							<?php foreach ($account_details as $account_detail): ?>	
								<div style="float:left;width:100%;display;block;line-height:14px;padding:8px 0px 8px 0px;">
									<div style="width:30%;float:left;margin-left:2%;font-size:13px;">
									<?php 
										//echo $account_detail['timestamp']; 
										echo date('d-m-y -- H:i:s', $account_detail['timestamp']);
									?>
									</div>
									<div style="width:25%;float:left;text-align:center;"><?php echo $account_detail['balance']; ?></div>
									<div style="width:20%;float:left;text-align:center;"><?php echo $account_detail['transaction']; ?></div>
									<div style="width:20%;float:left;text-align:center;">
										<?php
											echo $account_detail['transaction_type'] ? "Deposited" : "Withdrawn";
										?>
									</div>
								</div>
							<?php   endforeach;  ?>	
							</div>
						</p>
						
						<button class="btn-big" id="print-statement" style="font-size:20px;float:right;width:auto;height:auto;margin:15px;padding-top:1.8em;padding-bottom:1.8em;">Print Statement</button>
						<button class="btn-big" id="go-back" style="font-size:20px;float:right;width:auto;height:auto;margin:15px;padding-top:1.8em;padding-bottom:1.8em;">Go Back</button>
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
		</div>	
			
		<div class="md-overlay"></div><!-- the overlay element -->
		
		<audio id="sound1" autobuffer src="<?php echo base_url(); ?>audio/login/3.mp3"></audio>
		
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