<div class="question__plain-text">
	<?
	$num=1;
	$result = $question->text;
	do{
		$source = $result;
		$result = preg_replace(
			'/input\(\'([\s\S]*?)\'\)/',
			'<input class="question__writing_ans" type="text" data-q_offset="'.$num.'" data-value="$1" />',
			$source,
			1
		);
		$num++;
	}while($result != $source);
	
	echo $result;
	?>
</div>
<script type="text/javascript">
$(function(){
	words_wrap($('.question__plain-text'), onHover, onClick);
});
</script>
<script type="text/javascript">
$(function($){
	$('body').off('focusout','.question__writing_ans');
	$('body').on('focusout','.question__writing_ans',function(){
		if($(this).val() != ''){
			var right = $(this).data('value')==$(this).val();
			
			<? if(Yii::app()->user->role != 'teacher'){?>
			add_message({
				module: 'navigation',
				data: {
					'event':'answer',
					'type':'writing',
					'part_num':$(this).data('q_offset'),
					'ans':$(this).val()
				}
			});
			
			$.ajax({
				'type':'POST',
				'data':{
					'user_id':'<?=Yii::app()->user->id?>',
					'task_id':'<?=$question->id?>',
					'part_num':$(this).data('q_offset'),
					'ans':$(this).val(),
					'right':right
				},
				'url':'lesson/logAns',
				'cache':false,
				'success':function(html){},
				'dataType':'html'
			});
			<? }?>
			if(right){
				this.style.backgroundColor = '#E1F7E2';
				this.style.color = '#1B571D';
			}else{
				this.style.backgroundColor = '#FAEBEB';
				this.style.color = '#611F1F';
			}
		}
	});
	<? if(Yii::app()->user->role != 'teacher'){?>
	$('body').off('keyup','.question__writing_ans');
	$('body').on('keyup','.question__writing_ans',function(){		
		add_message({
			module: 'navigation',
			data: {
				'event':'typing',
				'type':'writing',
				'part_num':$(this).data('q_offset'),
				'ans':$(this).val()
			}
		});
	});
	<? }?>
});
</script>