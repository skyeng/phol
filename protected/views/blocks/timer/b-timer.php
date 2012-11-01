<div class="timer">
	<div class="timer__container">
		<?
			// 	$lesson_model->start_time 	в формате HH:MM:SS
			// 	$lesson_model->date 		в формате YYYY-MM-DD
			// 	вывод 						в формате september 16, 2012 10:41:30
			
			$time_array 	= explode(':',$lesson_model->start_time);
			$day_array		= explode('-',$lesson_model->date);
			$end_time 		= mktime($time_array[0],$time_array[1],$time_array[2],$day_array[1],$day_array[2],$day_array[0]);
			$end_time	   += 60*60;
			// date('F d, o H:i:s',$end_time);
		?>
		<img src="/images/clock.png" class="timer__clock" alt="Осталось времени" />
		<p class="timer__text">до конца занятия </p>
		<p class="timer__time" id="timer__time-left"></p>
	</div>
</div>