
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
        directions = ["up","hello","submit"];
    direction = direction.replace(/\W/g, "");
    if (direction === "") {
        return;
    }

   $('<span />').html(direction).appendTo('#commands');

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
    
    case 'hello':
        // $('.login').hide()
		document.getElementById("demo").innerHTML="My First JavaScript";
        break;	
    }
}


/*

function move(direction) {

    var animationTime = 2000,
        directions = ["up","left","down","right"];
    direction = direction.replace(/\W/g, "");
    if (direction === "") {
        return;
    }

    $('<span />').html(direction).appendTo('#commands');

    if (levenshteinLevel) {
        for (var i = 0; i < directions.length; i++) {
            if (levenshtein(directions[i], direction) <= levenshteinLevel) {
                direction = directions[i];
                break;
            }
        }
    }

    $('#directions div').removeClass('directionActive');
    $('#' + direction).addClass('directionActive');

    switch (direction) {
    case 'left':
        $('#box').animate({
            left: 0
        }, animationTime);
        break;
    case 'right':
        $('#box').animate({
            left: width - 50
        }, animationTime);
        break;
    case 'up':
        $('#box').animate({
            top: 0
        }, animationTime);
        break;
    case 'down':
        $('#box').animate({
            top: height - 50
        }, animationTime);
        break;	
    }
}

*/