$(function() {

	var audio;

	$('.btn-play-pause').on('click', function() {
        audio = $(this).parent().parent().prev('audio').get(0);
        
		//Play/pause the track
		if (audio.paused == false) {
			audio.pause();
			$(this).children('i').removeClass('fa-pause');
			$(this).children('i').addClass('fa-play');
		} else {
			audio.play();
			$(this).children('i').removeClass('fa-play');
			$(this).children('i').addClass('fa-pause');
		}
	});

	$('.btn-stop').on('click', function() {
        audio = $(this).parent().parent().prev('audio').get(0);
		//Stop the track
		audio.pause();
		audio.currentTime = 0;
		$('.btn-play-pause').children('i').removeClass('fa-pause');
		$('.btn-play-pause').children('i').addClass('fa-play');
	});
	
	$('.btn-mute').on('click', function() {
        audio = $(this).parent().parent().prev('audio').get(0);
		//Mutes/unmutes the sound
		if(audio.volume != 0) {
			audio.volume = 0;
			$(this).children('i').removeClass('fa-volume-off');
			$(this).children('i').addClass('fa-volume-up');
		} else {
			audio.volume = 1;
			$(this).children('i').removeClass('fa-volume-up');
			$(this).children('i').addClass('fa-volume-off');
		}
	});

	function updateProgress(id) {
		//Updates the progress bar
        audio = $('#'+id).get(0);
        
        var progress = $('#'+id).next('div').find('div').find('span');
        
		//var progress = document.getElementById("progress");
		var value = 0;
		if (audio.currentTime > 0) {
			value = (100 / audio.duration) * audio.currentTime;
		}
		progress.css('width', value + "%");
	}

    $('audio').each(function(){
        audio = $(this).get(0);
        var id = $(this).attr('id');
        audio.addEventListener("timeupdate", function(){updateProgress(id)}, false);
    })
	//Progress Bar event listener
	
});