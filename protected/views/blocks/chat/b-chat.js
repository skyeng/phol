function chat_handleEvent(event, data){
	$(".chat__frame").append("<p class='chat__line'><strong>"+chat__companion_name+":</strong> "+data+"</p>");
	$(".chat__frame").scrollTop(10000);
}

$(function() {
	$(document).bind('sync/chat', chat_handleEvent);

	$(".chat__send").click(function(){
		var str = $(".chat__input").val();
		if(str == '')
			return false;
		$(".chat__frame").append("<p class='chat__line'><strong>You:</strong> "+str+"</p>");
		$(".chat__frame").scrollTop(10000);
		$(".chat__input").val("");
		
		Sync.add_message({
			module:"chat",
			data: str
		});
		return false;
	});
	
	$(".chat__input").on('keyup', function(event){
		if(event.keyCode == 13){
			$(".chat__send").click();
		}
	});
});

