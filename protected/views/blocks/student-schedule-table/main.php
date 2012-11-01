<div class="student-schedule-table">
	<div class="student-schedule-table__container">
		<h2 class="student-schedule-table__title"><?=$this->T['beforeLesson']['next_lessons']?>:</h2>
		<? if($all){?>
		<table class="student-schedule-table__table">
			<tr>
				<th><?=$this->T['beforeLesson']['day_w']?></th>
				<th><?=$this->T['beforeLesson']['time']?></th>
				<th><?=$this->T['beforeLesson']['next_date']?></th>
				<th><?=($isTeacher?$this->T['beforeLesson']['partner_t']:$this->T['beforeLesson']['partner'])?></th>
			</tr>
		<? foreach($all as $one){?>
			<tr>
				<td><?=$one->dayWeek()?></td>
				<td><?=$one->normTime()?></td>
				<td><?=$one->normDate()?></td>
				<td><?=($isTeacher?($one->student->name.' '.$one->student->surname):($one->teacher->name.' '.$one->teacher->surname))?></td>
			</tr>
		<? }?>
		</table>
		<? }else{?>
		<p><?=$this->T['beforeLesson']['no_lessons']?></p>
		<? }?>
	</div>
</div>