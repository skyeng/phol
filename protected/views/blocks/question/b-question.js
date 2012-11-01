$(function(){		
	function question_get(type){
		if(type == 'next')
			data = {'lesson_id':$('#lesson_id').val(),'blocks':have_blocks};
		else if(type == 'prev')
			data = {'lesson_id':$('#lesson_id').val(),'blocks':have_blocks,'go':'back'};
		$.ajax({
			'type':'POST',
			'data':data,
			'url':'lesson/next',
			'cache':false,
			'success':function(data){
				$(".workplace__holder")[0].style.visible = 'none';
				$(".workplace").replaceWith(data.page);
				if(data.css != null)
					$('head').append('<style type="text/css">'+data.css+'</style>');
				if(data.js != null)
					$.globalEval(data.js);
				$(".workplace__holder")[0].style.visible = 'block';
				$.scrollTo('.workplace',800,{offset:0});
			},
			'dataType':'json'
		});
	}

	function question_next(){
		question_get('next');
		Sync.add_message({
			module: 'navigation',
			data: 'next-task'
		});
		return false;
	}

	function question_prev(){
		question_get('prev');
		Sync.add_message({
			module: 'navigation',
			data: 'prev-task'
		});
		return false;
	}

		
	$('.question__next-task').on('click',function(){question_next()});
	$('.question__prev-task').on('click',function(){question_prev()});
});