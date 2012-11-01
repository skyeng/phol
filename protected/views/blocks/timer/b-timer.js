$(document).ready(function() {
	$("#timer__time-left").countdown({
		date: "<?=date('F d, o H:i:s',$end_time)?>", 
		htmlTemplate: "%{h}:%{m}:%{s}",
		onChange: function( event, timer ){
		},
		onComplete: function( event ){
		
			$(this).html("Завершен");
		},
		leadingZero: true,
		direction: "down"
	});
});