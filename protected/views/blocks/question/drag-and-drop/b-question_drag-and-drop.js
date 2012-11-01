$(function(){
	words_wrap($('.question__drug-and-drop__droppable-elements__holder'), onHover, onClick);
});

$(document).ready(function(){
    var dragObjects = $('.question__drug-and-drop__draggable-element');
    for(var i=0; i<dragObjects.length; i++)
        new DragObject(dragObjects[i]);
	
	var dropObjects = $('#dropObjects span');
    for(var i=0; i<dropObjects.length; i++)
        new DropTarget(dropObjects[i]);
	
	if($('#isTeacher').val() == 'teacher'){
		add_message({
			module: 'navigation',
			data: {
				'event':'dnd_need_order'
			}
		});
	}
});

function dragAndDrop_moveIn(drag_id, drop_id){
	var width = $('#'+drag_id)[0].offsetWidth+'px';
	var oldPlace = $('#'+drag_id).parent();
	$('#'+drag_id).detach().appendTo('#'+drop_id);
	$('#'+drag_id)[0].style.margin = '0';
	$('#'+drop_id)[0].style.width = width;
	if($('#'+drag_id+'_back')[0] == null)
		$('#drop'+drag_id.substring(4)).append('<div id="'+drag_id+'_back" class="question__drug-and-drop__draggable-element__phantom">'+$('#'+drag_id).html()+'</div>');
	else
		dragAndDrop_check(oldPlace.attr('id'));
	$('#'+drag_id).trigger('drag_in');
}

function dragAndDrop_moveOut(drag_id){
	var drop = $('#'+drag_id).parent();
	var drag = $('#'+drag_id);
	var oldPlace = $('#drop'+drag.attr('id').substring(4));
	$('#word'+drag.attr('id').substring(4)+'_back').remove();
	drag[0].style.margin = '0 5px';
	drop[0].style.width = '70px';
	drag.detach().appendTo(oldPlace);
	$('#'+drag_id).trigger('drag_out');
	return drop.attr('id');
}

function dragAndDrop_check(drop_id){
	if(drop_id.substr(0,1) != '_')
		return;
	var j=0;
	var fail=true;
	if($('#'+drop_id+' div').html() != null){
		while($('#'+drop_id).data('value_'+j) != null){
			if($('#'+drop_id).data('value_'+j) == $('#'+drop_id+' div').html()){
				fail = false;
				break;
			}
			j++;
		}
		if(fail)
			$('#'+drop_id)[0].style.boxShadow = '0 1px 1px rgba(0, 0, 0, 0.3) inset, 0px 0px 8px rgba(255, 85, 85, 0.9)';
		else
			$('#'+drop_id)[0].style.boxShadow = '0 1px 1px rgba(0, 0, 0, 0.3) inset, 0px 0px 8px rgba(85, 255, 85, 0.9)';
	}else
		$('#'+drop_id)[0].style.boxShadow = '0 1px 1px rgba(0, 0, 0, 0.3) inset, 0 1px white';
}