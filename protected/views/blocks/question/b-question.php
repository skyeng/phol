<? $this->need('jquery');?>
<? $this->need('scrollTo');?>
<div class="question">
	<div class="question__container">
		<?=$modifier?>
		<div class="question__next-task__container">
		<? if(!$isFirst){?>
			<div class="button question__prev-task">Back</div>
		<? }?>
		<div class="button question__next-task"><strong>More</strong>, dear Skyeng!</div>
		</div>
	</div>
</div>