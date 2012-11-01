function navigation_handleEvent(event, data){
	if(data == 'go-to-lesson'){
                //временно - редиректил до отправки доставки
        	//window.setTimeout(function(){window.location.assign('/lesson')}, 5000);
	}else if(data.event == 'add_word'){
		$('.b-word-translation__queue').append('&bull; '+data.word+'<br />');
	}else if(data.event == 'dnd_need_order'){
		var order = Array();
		$('#dragObjects .question__drug-and-drop__draggable-element__holder').each(function(){
			order.push($(this).attr('id'));
		});
		Sync.add_message({
			module: 'navigation',
			data: {
				'event':'dnd_order',
				'order':order
			}
		});
	}else if(data == 'next-task'){
		question_get('next');
	}else if(data == 'prev-task'){
		question_get('prev');
	}else if(data == 'finish'){
		window.location.assign('/afterLesson');
	}
}

$(function() {
	$(document).bind('sync/navigation', navigation_handleEvent);
});