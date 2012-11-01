<<<<<<< HEAD
<?/*
	BLOCK:			N E X T _ L E S S O N
    MODIFICATOR:	M A I N 
*/?>

<?	$this->need('jquery');?>
<div class="next-lesson">
	<div class="next-lesson__container">
		<? if(!$next){?>
			<p><?=$this->T['b-next-lesson']['no_lessons_planned']?></p>			<!-- Занятий не запланировано -->
		<? }else{?>
			<p>
				<?=	$isTeacher?
                        $this->T['b-next-lesson']['your_next_lesson_teacher']: 	//	Your next lesson:
                        $this->T['b-next-lesson']['your_next_lesson']						//	Your next lesson:
                ?>:
				<span class="next-lesson__time">
                	<strong><?=$next->normDate()?></strong>						<!-- 29 october -->
					(<?=mb_strtolower($next->dayWeek(),'UTF-8')?>),						<!-- (monday) -->
					<?=$this->T['b-next-lesson']['at']?>											<!-- at -->
                    <strong><?=$next->normTime()?></strong>					<!-- 11:00 -->
                </span>
            </p>
            <p>
            	<?=	$isTeacher?
						$this->T['b-next-lesson']['your_student_is']:						// Your teacher is
						$this->T['b-next-lesson']['your_teacher_is'];
				?>
				<strong><?=$partner->name?></strong>.												<!-- Ivan -->
                <?=	$isTeacher?
						$this->T['b-next-lesson']['you_can_connect_him_t']:			// You can connect him using Skype. -->
						$this->T['b-next-lesson']['you_can_connect_him_s'];
				?>
                <a href="http://www.skype.com/intl/en/get-skype/on-your-computer/windows/">Skype</a>,
                <?=$this->T['b-next-lesson']['his_nick_name']?>					<!-- His nick-name is -->
                <img src="/images/blocks/next-lesson/skype-small-icon.png" class="next-lesson__skype-small-icon" />
                <strong><?=$partner->skype?></strong>.							<!-- axerok -->
            </p>
			<? if($next->isLessonNow()){?>
				<p>
					<?=	$isTeacher?
                        $this->T['b-next-lesson']['enter_completed_teacher']:	// Ожидайте входа ученика
                        $this->T['b-next-lesson']['enter_completed']					// Ожидайте входа учителя
                    ?>
                </p>
			<? }else{?>
				<p>
					<?=	$isTeacher?
                            $this->T['b-next-lesson']['you_can_enter_after_teacher']:		// 	Можете войти за 5 минут
                            $this->T['b-next-lesson']['you_can_enter_after_student']		// 	Можете войти за 5 минут
                    ?>
                </p>
				<script type="text/javascript">
					$(function(){
						window.clearInterval(sync_interval);
					});
				</script>
			<? }?>
		<? }?>
	</div>
=======
<?/*
	BLOCK:			N E X T _ L E S S O N
  MODIFICATOR:	M A I N 
*/?>

<? $this->need('jquery');?>
<div class="next-lesson">
	<div class="next-lesson__container">
		<? if(!$next){?>
			<p><?=$this->T['b-next-lesson']['no_lessons_planned']?></p>			<!-- Занятий не запланировано -->
		<? }else{?>
			<p>
				<?=	$isTeacher?
          $this->T['b-next-lesson']['your_next_lesson_teacher']: 	//	Your next lesson:
          $this->T['b-next-lesson']['your_next_lesson']			//	Your next lesson:
        ?>:
				<span class="next-lesson__time">
          <strong><?=$next->normDate()?></strong>						<!-- 29 october -->
					(<?=mb_strtolower($next->dayWeek(),'UTF-8')?>),				<!-- (monday) -->
					<?=$this->T['b-next-lesson']['at']?>						<!-- at -->
          <strong><?=$next->normTime()?></strong>						<!-- 11:00 -->
        </span>
      </p>
      <p>
        <?=	$isTeacher?
          $this->T['b-next-lesson']['your_student_is']:			// Your teacher is
          $this->T['b-next-lesson']['your_teacher_is'];
				?>
				<strong><?=$partner->name?></strong>.							<!-- Ivan -->
        <?=	$isTeacher?
          $this->T['b-next-lesson']['you_can_connect_him_t']:		// You can connect him using Skype. -->
          $this->T['b-next-lesson']['you_can_connect_him_s'];
				?>
        <a href="http://www.skype.com/intl/en/get-skype/on-your-computer/windows/">Skype</a>,
        <?=$this->T['b-next-lesson']['his_nick_name']?>					<!-- His nick-name is -->
        <img src="/images/blocks/next-lesson/skype-small-icon.png" class="next-lesson__skype-small-icon" />
        <strong><?=$partner->skype?></strong>.							<!-- axerok -->
      </p>
			<? if($problem == 'empty_balance'){?>
        <p>
          <?=$this->T['b-next-lesson']['empty_balance']?>
        </p>
      <? }else{
        if($next->isLessonNow()){?>
          <p>
            <?=	$isTeacher?
              $this->T['b-next-lesson']['enter_completed_teacher']:	// Ожидайте входа ученика
              $this->T['b-next-lesson']['enter_completed']			// Ожидайте входа учителя
            ?>
          </p>
        <? }else{?>
          <p>
            <?=	$isTeacher?
              $this->T['b-next-lesson']['you_can_enter_after_teacher']:		// 	Можете войти за 5 минут
              $this->T['b-next-lesson']['you_can_enter_after_student']		// 	Можете войти за 5 минут
            ?>
          </p>
          <script type="text/javascript">
            $(function(){
              window.clearInterval(sync_interval);
            });
          </script>
        <? }
      }?>
		<? }?>
	</div>
>>>>>>> balances_issue#5
</div>