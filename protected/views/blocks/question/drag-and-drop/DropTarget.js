function DropTarget(element) {
	
	element.completeness = 0;
	element.dropTarget = this
	
	this.canAccept = function(dragObject) {
		return true
	}
	
	this.accept = function(dragObject) {
		this.onLeave()
		
		dragObject.hide()
		
	}
	
	this.onLeave = function() {
	    
	    if (!element.completeness)
		{
			element.className =  'question__drug-and-drop__droppable-element'
		}
	}
	
	this.onEnter = function() {
	    if (!element.completeness)
		{
			element.className = 'question__drug-and-drop__droppable-element__over'
		}
	}
	
	this.toString = function() {
		return element.id
	}
}
