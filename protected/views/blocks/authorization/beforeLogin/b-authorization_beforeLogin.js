/*
	BLOCK: A U T H O R I Z A T I O N
	MODIFICATOR: B E F O R E _ L O G I N
*/

$(document).ready(function() {
	$(".authorization input").keyup(function(event){
		if(event.keyCode == 13){
			$("a.authorization__login").click();
		}
	});
});