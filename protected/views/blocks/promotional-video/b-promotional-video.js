$(document).ready(function() {
	$(".promotional-video img").click(function() {
		$(".index-video-player__holder").toggle();
		window.setTimeout(function(){
			$.scrollTo('.index-video-player__holder',800,{offset:-100});
		}, 1000);
	});
});