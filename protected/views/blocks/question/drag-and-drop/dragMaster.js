var dragMaster = (function() {
    var dragObject
    var mouseDownAt
	var currentDropTarget
	var dragElement
	var dropElement
	function mouseDown(e) {
		e = fixEvent(e)
		if (e.which!=1) return
 		mouseDownAt = { x: e.pageX, y: e.pageY, element: this }
		addDocumentEventHandlers()
		return false
	}


	function mouseMove(e){
		e = fixEvent(e)
		if (mouseDownAt) {
			if (Math.abs(mouseDownAt.x-e.pageX)<5 && Math.abs(mouseDownAt.y-e.pageY)<5) {
				return false
			}
			var elem  = mouseDownAt.element
			dragElement = mouseDownAt.element;
			dragObject = elem.dragObject
			var mouseOffset = getMouseOffset(elem, mouseDownAt.x, mouseDownAt.y)
			mouseDownAt = null // запомненное значение больше не нужно, сдвиг уже вычислен
			dragObject.onDragStart(mouseOffset) // начали
			if (elem.initialPosition==2)
			{
				var MyDropObject = document.getElementById(elem.dropId+'')
				MyDropObject.className = 'question__drug-and-drop__droppable-element'
			}
			elem.className = 'question__drug-and-drop__draggable-element'
		    if(elem.initialPosition == 0)
			{
            var backword = document.createElement('div');
            backword.className = 'question__drug-and-drop__draggable-element__phantom';
            backword.id = elem.id + '_back';
			var str = (elem.id + '').substring(4);
			var parent = document.getElementById('drop' + str);
            var text = elem.innerHTML;
            var textNode = document.createTextNode(text);
            backword.appendChild(textNode);
            parent.appendChild(backword);
			elem.initialPosition = 1;
	 		}
		}
		dragObject.onDragMove(e.pageX, e.pageY)
		var newTarget = getCurrentTarget(e)
		if (currentDropTarget != newTarget) {
			if (currentDropTarget) {
				currentDropTarget.onLeave()
			}
			if (newTarget) {
				newTarget.onEnter()
			}
			currentDropTarget = newTarget
		}
		return false
    }
	
	
    function mouseUp(){
		if (!dragObject) { // (1)
			mouseDownAt = null
		} else {
			// (2)
			
			if (((currentDropTarget)&&(dropElement.completeness == 0))||((currentDropTarget)&&(dropElement.completeness == 1)&&((dropElement.id+'')==dragElement.dropId))) {
				var width = $('#'+dragElement.id)[0].offsetWidth+'px';
				
				currentDropTarget.accept(dragObject);
				dragObject.onDragSuccess(dropElement);
								var old_drop_id = $('#'+dragElement.id).parent().attr('id');					
				var ppp = document.getElementById(dragElement.id + '')
				var rcont = document.getElementById(ppp.parentNode.id+'');
				var rpar = document.getElementById(dragElement.id + '')
				var rel=rcont.removeChild(rpar);
				
				if (rel.initialPosition==2)
				{
					var MyDropObject = document.getElementById(rel.dropId+'')
		         	MyDropObject.completeness = 0;										//проверка старого поля (если тянется не со страта)					dragAndDrop_check(old_drop_id);
				}

                var newspan = document.createElement('div');
                newspan.className = rel.className;
                newspan.id = rel.id;
				//var text = rel.innerHTML;
                //var textNode = document.createTextNode(text);
                newspan.innerHTML = rel.innerHTML
				
				dropElement.appendChild(newspan);
                //dropElement.className = '';
				var newDragObject = document.getElementById(newspan.id+'');
				newDragObject.style.margin = '0';
				dropElement.style.width = width;
				dropElement.completeness=1;
				
				//var newDragObject = document.getElementById(newspan.id+'')
                new DragObject(newDragObject);
				newDragObject.initialPosition = 2;
				var str0 = dropElement.id + '';
				newDragObject.dropId = str0;
				//----------
								//проверка нового поля (в которое бросили)				dragAndDrop_check(dropElement.id);
			} else {
				dragObject.onDragFail()
			}

			dragObject = null
		}

		// (3)
		removeDocumentEventHandlers()
    }


	function getMouseOffset(target, x, y) {
		var docPos	= getOffset(target)
		return {x:x - docPos.left, y:y - docPos.top}
	}

	
	function getCurrentTarget(e) {
		// спрятать объект, получить элемент под ним - и тут же показать опять
		
		if (navigator.userAgent.match('MSIE') || navigator.userAgent.match('Gecko')) {
			var x=e.clientX, y=e.clientY
		} else {
			var x=e.pageX, y=e.pageY
		}
		// чтобы не было заметно мигание - максимально снизим время от hide до show
		dragObject.hide()
		var elem = document.elementFromPoint(x,y)
		dragObject.show()
		
		// найти самую вложенную dropTarget
		while (elem) {
			// которая может принять dragObject 
			if (elem.dropTarget && elem.dropTarget.canAccept(dragObject)) {
			    //--George--
				dropElement = elem;
				//----------
				return elem.dropTarget
			}
			elem = elem.parentNode
		}
		
		// dropTarget не нашли
		return null
	}


	function addDocumentEventHandlers() {
		document.onmousemove = mouseMove
		document.onmouseup = mouseUp
		document.ondragstart = document.body.onselectstart = function() {return false}
	}
	function removeDocumentEventHandlers() {
		document.onmousemove = document.onmouseup = document.ondragstart = document.body.onselectstart = null
	}


    return {

		makeDraggable: function(element){
			element.onmousedown = mouseDown
			$('#'+element.id).bind('drag_in', function(){
				element.initialPosition = 2;
				//completeness=1 Андрюх, у меня к тебе пару вопросов возникло, я еще посмотрю как он в реальности сейчас работает и точно смогу сказать что там не так.
				/*if (element.initialPosition==2)
				{
					var MyDropObjectNew = document.getElementById(element.dropId+'')
		         	MyDropObjectNew.completeness = 0
				}
				element.initialPosition = 2;
				element.dropId = 
				*/
				
				
			});
			$('#'+element.id).bind('drag_out', function(){
				element.initialPosition = 0;
				//completeness=0
				/*if (element.initialPosition==2)
				{
					var MyDropObjectNew = document.getElementById(element.dropId+'')
		         	MyDropObjectNew.completeness = 0
				}
				element.initialPosition = 0;
				element.dropId = 
				*/
			});
		}
    }
}())