$(document).ready(function() {

	if (!('webkitSpeechRecognition' in window)) {

		$('.not-supported').show();
		$('.supported').hide();

	} else {


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
		case 'hello':
			$("#back2").click();	
			break;	
		case 'information':
		case 'morning':
			$("#more-info").click();	
			break;	
		}
	}

});
