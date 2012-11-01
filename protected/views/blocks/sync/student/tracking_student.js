function logit(o){
	s="";
	for(var i=0; i<o.length; i++){
		s+="x:"+o[i].x+", c:"+o[i].clicked+	";     ";
	}
	console.log(s);
}


$(function() {
	$(document).bind('sync/tracking', function(e, data){
		if(data == 'need-window-size')
			Sync.add_message({
				module: 'tracking',
				data: {
					type: 'resize',
					width: $('.main').width()
				}
			});
	});

	var coord = [];		// array with mouse positions
	var curpos = {x:0,y:0};	// current mouse position
	var clicked = false;

	$(document).on('mouse/track/write',function(e){
		// add mouse position to array
		// coord.push(curpos);
		if(clicked){
			coord.push({
				x: curpos.x,
				y: curpos.y,
				clicked: true
			});
			clicked = false;
		}else{
			coord.push(curpos);
		}
		// console.log(coord.length)
		// if there enough positions, send them and empty list
		if(coord.length > 4 ){
			//console.log(coord);
			Sync.add_message({
				module: 'tracking',
				data: {
					type: 'track-array',
					array: coord
				}
			});
			// logit(coord);
			// console.log(coord);
			coord = [];
		}
		
		// repeat in 100 ms
		setTimeout(function(){
			//$(document).trigger('mouse/track/write');
		}, 100);
	});

	// start tracking
	$(document).trigger('mouse/track/write');

	// save current mouse position to curpos
	$('.main').mousemove(function(e){
    	curpos = {
			x: e.pageX - $(this).offset().left,
			y: e.pageY - $(this).offset().top,
		};
   });

	// if click save to click
	$('.main').click(function(e){
		// console.log('click');
    	clicked = true;
   });

	// $('.main').click(function(e){
 //    	console.log(e)
 //   });

	// when resize, send new size of the container
	$(window).resize(function(){
		// console.log('resize');
		Sync.add_or_update_message({
			module: 'tracking',
			data: {
				type: 'resize',
				width: $('.main').width()
			}
		}, function(m){
			return (m.module == 'tracking')
				&& (m.data.type == 'resize');
		});
	});

	// send container width
	Sync.add_message({
		module: 'tracking',
		data: {
			type: 'resize',
			width: $('.main').width()
		}
	});
});