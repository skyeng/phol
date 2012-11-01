<?/*
	PAGE: I N D E X
    MODIFICATOR: M A I N
*/?>
<? $this->block('sync/'.($isTeacher?'teacher':'student')); ?>

<div class="tools__holder">
    <div class="tools">
        <div class="tools__container">
            <div class="chat__holder">
                <? $this->block('chat', array('lesson_model'=>$lesson_model,'isTeacher' => $isTeacher));?>
            </div>
            <div class="translator__holder">
                <? $this->block('translator');?>
            </div>
            <? $this->block('lesson-new-words-list', array('words'=>$words) );?>
            <div class="b-word-translation__holder">
            	<? $this->block('word-translation');?>
            </div>
            <? // if($isTeacher) $this->block('teacher-change-mode-button'); ?>
        </div>
    </div>
</div>
<div class="workplace__holder">
    <?
    if($finish == 'now'){
        $this->block('workplaceAfter', array(
            'trigger'=>$trigger,
            'lesson_id'=>$lesson_id,
        ));
    }else{
        $this->block('workplace', array(
            'task'		=>$task,
            'question'	=>$question,
            'isTeacher'	=>$isTeacher,
            'isFirst'	=>$isFirst
        ));
    }?>
    <input type="hidden" id="lesson_id" value="<?=$lesson_id?>" />
    <input type="hidden" id="isTeacher" value="<?=$isTeacher?'teacher':'student'?>" />
	<!--HAVE_BLOCKS-->
</div>
<div class="clear"></div>