<?/*
	PAGE:			A F T E R _ L E S S O N
    MODIFICATOR:	M A I N 
*/?>

<div class="main__body__padding">
    <h2 class="after-lesson__title-first">
		<?=$this->T['p-after-lesson']['great']?>,						<!-- Отлично, -->
		<?=Yii::app()->user->name?>!									<!-- Иван -->
    </h2>
    <p class="after-lesson__information">
		<?=$this->T['p-after-lesson']['first_lesson_ended']?>			<!-- Ты только что прошел свой первый урок.. -->
    </p>
    <p class="after-lesson__information">
		<?=$this->T['p-after-lesson']['look']?>							<!-- Смотри, мы сформировали для тебя -->
        <a href=""><?=$this->T['p-after-lesson']['hometask']?></a>,		<!-- домашнее задание -->
        <?=$this->T['p-after-lesson']['in_privat_cabinet']?>.</p>		<!-- можешь найти в личном кабинете -->
    
    <h2 class="after-lesson__title">
		<?=$this->T['p-after-lesson']['free_lesson']?>					<!-- Бесплатное занятие -->
    </h2>
    <p class="after-lesson__information">
		<?=$this->T['p-after-lesson']['free_lesson_info']?>				<!-- расскажи своим друзьям о нас -->
    </p>
</div>

<div class="next-lesson__holder">
    <?
    	$this->block('next-lesson',array(
				'next'		=>	$next,
				'isTeacher'	=>	$isTeacher,
				'partner'	=>	$partner,
		));
	?>
</div>

<div class="lessons-left-widget__holder">
    <? $this->block('lessons-left-widget');?>
</div>

<div class="student-schedule-table__holder">
    <?
		$this->block('student-schedule-table',array(
					'all'		=>	$all,
					'isTeacher'	=>	$isTeacher,
		));
	?>
</div>

<div class="clear"></div>