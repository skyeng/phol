<h2 class="main__body__padding"><?=$isTeacher?$this->T['beforeLesson']['greeting_t']:$this->T['beforeLesson']['greeting']?> <?=Yii::app()->user->name?>!</h2>
<div class="sync__holder" style="display:none;">
  <? $this->block('sync/'.($isTeacher?'teacher':'student')); ?>
</div>
<div class="next-lesson__holder">
  <?
  $this->block('next-lesson',array(	
    'next'		=>	$next,
    'isTeacher'	=>	$isTeacher,
    'partner'	=>	$partner,
    'problem' => $problem,
  ));
  ?>
</div>
<? if(!$isTeacher){?>
<div class="lessons-left-widget__holder">
  <? $this->block('lessons-left-widget');?>
</div>
<? }?>
<div class="student-schedule-table__holder">
  <?
    $this->block('student-schedule-table',array(
            'all'		=>	$all,
            'isTeacher'	=>	$isTeacher,
    ));
  ?>
</div>
<div class="clear"></div>