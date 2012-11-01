<table class="question__table">
<?
$json = json_decode($question->text, true);
foreach($json as $i=>$task){?>
	<tr>
		<td><div class="question__number"><?=$this->task_offset?></div></td>
		<td>
			<p class="question__title"><?=$task["q"]?></p>
			<form class="question__variants-form"><?
				foreach($task["a"] as $j=>$ans){?>
				<p><input type="radio" name="sex" class="question__test_ans" data-q_offset="<?=$this->task_offset?>" data-q_ans="<?=$j?>" data-right="<?=(int)($ans[1]=='r')?>" /><?=$ans[0]?></p><?
				}?>
			</form>
		</td>
		<td class="question__status_<?=$this->task_offset?>"></td>
	</tr>
	<tr>
		<td></td><td><div class="hr"></div></td><td></td>
	</tr><?
	$this->task_offset++;
}?>
</table>
<script type="text/javascript">
$(function(){
	words_wrap($('.question__table'), onHover, onClick);
});

$(function($){
	$('body').off('click','.question__test_ans');
	$('body').on('click','.question__test_ans',function(){
		<? if(Yii::app()->user->role != 'teacher'){?>
		add_message({
			module: 'navigation',
			data: {
				'event':'answer',
				'type':'test',
				'part_num':$(this).data('q_offset'),
				'ans':$(this).data('q_ans')
			}
		});
		
		$.ajax({
			'type':'POST',
			'data':{
				'user_id':'<?=Yii::app()->user->id?>',
				'task_id':'<?=$question->id?>',
				'part_num':$(this).data('q_offset'),
				'ans':$(this).data('q_ans'),
				'right':$(this).data('right')
			},
			'url':'lesson/logAns',
			'cache':false,
			'success':function(html){},
			'dataType':'html'
		});
		<? }?>
		if($(this).data('right'))
			$('.question__status_'+$(this).data('q_offset')).html('<img src="images/success-icon.png" class="question__status-icon"/>');
		else
			$('.question__status_'+$(this).data('q_offset')).html('<img src="images/wrong-icon.png" class="question__status-icon"/>');
	});
});
</script>