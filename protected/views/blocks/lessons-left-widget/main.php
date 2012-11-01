<div class="lessons-left-widget">
	<div class="lessons-left-widget__container">
		<p class="lessons-left-widget__title"><?=$this->T['beforeLesson']['left']?></p>
		<p class="lessons-left-widget__number"><?=Yii::app()->user->extraInfo()->lessons_left?></p>
		<div class="lessons-left-widget__recharge button"><?=$this->T['beforeLesson']['add']?></div>
	</div>
</div>