// function logit(o){
// 	s="";
// 	for(var i=0; i<o.length; i++){
// 		s+="x:"+o[i].x+", c:"+o[i].clicked+	";     ";
// 	}
// 	console.log(s);
// }

$(function() {
	var coord = [];		// mouse position list
	var i = 0;			// iterator in the coord list
	
	// function to process incoming data
	function tracking_handleEvent(event, data){
		switch(data.type){
			case 'track-array':
				i = 0;
				coord = data.array;
				// logit(coord);
				break;
			case 'resize':
				// console.log(data.width);
				$('.main').width(data.width);
				break;
			case 'click':
				break
		}
	}

	// call func when data comes
	$(document).bind('sync/tracking', tracking_handleEvent);

	// insert cursor into the page
	$('html').prepend('<div class="b-sync__tracking_teacher__cursor"><img id="cursor" src="/images/student-pointer.cur" style="position:absolute;left:0px;top:0px; z-index:1000;"></div>');
	$cursor = $('#cursor');
	
	$('.main').on('mouse/track/read',function(e){
		// go to the new position if possible
		if( i < coord.length){
			$cursor.css({left:coord[i].x+$(this).offset().left,
				top:coord[i].y+$(this).offset().top});
			if(coord[i].clicked){
				coord[i].clicked = false;
				// console.log('click');
				$cursor.animate({
				    width: '+=32',
				    height: '+=32'
				  }, 200, function(){
				  	$(this).css({
					    width:  32,
					    height: 32
				  	})
				  });
			}
			i++;
		}

		// repeat in 100 ms
		setTimeout(function(){
			$('.main').trigger('mouse/track/read');
		}, 100);
	});

	// start tracking
	$('.main').trigger('mouse/track/read');

	// send message on load about need in window size
	Sync.add_message({
		module: 'tracking',
		data: 'need-window-size'
	});

	//
	$(document).bind('set/view-mode/teacher', function(event, data) {
    switch(data.mode){
      case 'student-view':
        $cursor.show();
        break;
      default:
        $cursor.hide();
    }
  });
});