function DragObject(element) {
	
	
	element.dropId = ''
	element.initialPosition = 0;	
    	
	element.dragObject = this
	
	dragMaster.makeDraggable(element)
	
	element.rememberPosition
	var mouseOffset
	
	this.onDragStart = function(offset) {
		var s = element.style
		if (element.initialPosition==0)
		{
			element.rememberPosition = {top: s.top, left: s.left, position: s.position}
		}
		s.position = 'absolute'
		mouseOffset = offset
	}
		
	this.hide = function() {
		element.style.display = 'none' 
	}
	
	this.show = function() {
		element.style.display = '' 
	}
	
	this.onDragMove = function(x, y) {
		element.style.top =  y - mouseOffset.y - getAbsolutePosition(document.getElementById('question__drug-and-drop')).y + 'px';
		element.style.left = x - mouseOffset.x - getAbsolutePosition(document.getElementById('question__drug-and-drop')).x + 'px';
	}
	
	this.onDragSuccess = function(dropElement) {
		////
		console.log(element.id+' in '+dropElement.id);
		add_message({
			module: 'navigation',
			data: {
				'event':'answer',
				'type':'drag-and-drop',
				'direction':'in',
				'drop_id':dropElement.id,
				'drag_id':element.id
			}
		});
	}
	
	this.onDragFail = function() {
		////
	    console.log(element.id+' out');
		add_message({
			module: 'navigation',
			data: {
				'event':'answer',
				'type':'drag-and-drop',
				'direction':'out',
				'drag_id':element.id
			}
		});
		
	    if (element.initialPosition==1)
		{
			var s = element.style
			s.top = element.rememberPosition.top
			s.left = element.rememberPosition.left
			s.position = element.rememberPosition.position
		
			var str = element.id + '_back';
			document.getElementById(str).parentNode.removeChild(document.getElementById(str));	

			element.initialPosition = 0;	
		}
		if (element.initialPosition==2)
		{
			var source = $('#'+element.id).parent();
			
			var elId = document.getElementById(element.id + '')
			var rcont = document.getElementById(elId.parentNode.id+'');
			var rpar = document.getElementById(element.id + '')
			var rel=rcont.removeChild(rpar);
			var str = (rel.id + '').substring(4);
			var oldSpan = document.getElementById('word'+str+'_back');
			var oldSpanParent =  document.getElementById(oldSpan.parentNode.id+'');
			var delteSpan = oldSpanParent.removeChild(oldSpan);
			
			var backword = document.createElement('div');
            backword.className = 'question__drug-and-drop__draggable-element';
            backword.id = 'word' + str;
			
			var parent = document.getElementById('drop' + str);
		    var text = rel.innerHTML;
            var textNode = document.createTextNode(text);
            backword.appendChild(textNode);
            parent.appendChild(backword);
			var MyDropObject = document.getElementById(element.dropId+'')
			MyDropObject.completeness = 0
			var MyDragObject = document.getElementById(backword.id+'')
			new DragObject(MyDragObject)
						//проверка поля, откуда элемент выкинули
			dragAndDrop_check(source.attr('id'));
			
			$('#'+element.id)[0].style.margin = '0 5px';
			source[0].style.width = '70px';
		}
	}
	
	this.toString = function() {
		return element.id
	}
}

function getAbsolutePosition(el) {
	var r = { x: el.offsetLeft, y: el.offsetTop };
	if (el.offsetParent) {
		var tmp = getAbsolutePosition(el.offsetParent);
		r.x += tmp.x;
		r.y += tmp.y;
	}
	return r;
}