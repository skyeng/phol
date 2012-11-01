<?
	$interlocutor = $isTeacher ? $lesson_model->student:$lesson_model->teacher;
	$interlocator_status = $isTeacher ? 'student' : 'teacher';
?>
<div class="chat">
	<div class="chat__container">
		<p class="chat__name">
			Chat with <strong><?=$interlocutor->name?></strong><!--
			-->, your <?=$interlocator_status?></p>
		<div class="chat__frame">
		</div>
		<input class="chat__input">
		<span  class="chat__send"><a href="">Send</a></span>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
	var chat__companion_name = '<?=$interlocutor->name?>';
</script>