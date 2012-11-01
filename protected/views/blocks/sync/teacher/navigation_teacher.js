function navigation_handleEvent(event, data){
	if(data == 'go-to-lesson'){
		//временно - редиректил до отправки доставки
                //window.setTimeout(function(){window.location.assign('/lesson')}, 5000);
	}else if(data.event == 'typing'){
		if(data.type == 'writing'){
			var input = $('input[data-q_offset='+data.part_num+']');
			input.val(data.ans);
		}
	}else if(data.event == 'answer'){
		if(data.type == 'test'){
			$('input[data-q_offset='+data.part_num+'][data-q_ans='+data.ans+']').click();
		}else if(data.type == 'writing'){
			var input = $('input[data-q_offset='+data.part_num+']');
			input.val(data.ans);
			input.focusout();
		}else if(data.type == 'drag-and-drop'){
			var dropToCheck;
			if(data.direction == 'in'){
				dragAndDrop_moveIn(data.drag_id, data.drop_id);
				dropToCheck = data.drop_id;
			}else
				dropToCheck = dragAndDrop_moveOut(data.drag_id);
			dragAndDrop_check(dropToCheck);
		}
	}else if(data.event == 'add_word'){
		$('.b-word-translation__queue').append('&bull; '+data.word+' ('+data.translation+')<br />');
	}else if(data.event == 'dnd_order'){
		for(i=data.order.length; i>0; i--)
			$('#'+data.order[i-1]).detach().prependTo('#dragObjects');
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