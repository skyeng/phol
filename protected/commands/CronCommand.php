<?
class CronCommand extends CConsoleCommand
{
	//cron 0 4 * * 0
    public function actionGenLessonHistory(){
		$arr = SchTeacher::model()->findAll('vacant=0');
		
		if($arr){
			foreach($arr as $les){
				if($les->day_w == date('w') && $les->time >= date('G')){
					$ts = strtotime('today') + $les->time*60*60;
				}else{
					$ts = strtotime('next '.$this->dayWeekEn($les->day_w)) + $les->time*60*60;
				}
				
				$ts_arr = array($ts, strtotime('+1 week', $ts));
				foreach($ts_arr as $one){
					$finded = LessonHistory::model()->find('sch_id=:ID and date=:DATE',array(
						':ID'=>$les->id,
						':DATE'=>$this->date($one),
					));
					if(!$finded){
						$new = new LessonHistory;
						$new->teacher_id = $les->teacher_id;
						$new->student_id = $les->student_id;
						$new->sch_id = $les->id;
						$new->date = $this->date($one);
						$new->start_time = $this->time($one);
						$new->save();
					}
				}
			}
		}
	}
	
	//cron 30 * * * *
    public function actionCloseLessons(){
		if(date('G') == 0){
			$finded = LessonHistory::model()->findAll('status<>:ST and (date<:DATE)',array(
				':ST'=>LESSON__COMPLETED,
				':DATE'=>$this->date(),
			));
		}else{
			$finded = LessonHistory::model()->findAll('status<>:ST and (date<:DATE or date=:DATE and start_time<:TIME)',array(
				':ST'=>LESSON__COMPLETED,
				':DATE'=>$this->date(),
				':TIME'=>$this->time(time()-60*60),
			));
		}
		if($finded){
			foreach($finded as $lesson){
        $new_status = LESSON__FAILED;
				switch($lesson->status){
					case LESSON__PLANED:$lesson->fail_reason = 'никто не пришёл';break;
					case LESSON__STUDENT_IN:$lesson->fail_reason = 'учитель не пришёл';break;
					case LESSON__TEACHER_IN:$lesson->fail_reason = 'ученик не пришёл';break;
					case LESSON__IN_PROGRESS:
            $lesson->fail_reason = 'завершён принудительно';
            $lesson->end_time = $this->time();
            $new_status = LESSON__COMPLETED;
            
            $student = Student::model()->findByPk($lesson->student_id);
            $student->lessons_left--;
            $student->save();

            $teacher = Teacher::model()->findByPk($lesson->teacher_id);
            $teacher->lessons_total++;
            $teacher->lessons_not_payed++;
            $teacher->save();
            
            break;
					default:$lesson->fail_reason = 'проваленый урок в будущем??';break;
				}
				$lesson->status = $new_status;
				$lesson->save();
			}
		}
	}
	
	//дата для записи в базу
	protected function date($ts=null){
		return $ts?date('Y-m-d', $ts):date('Y-m-d');
	}
	
	//время для записи в базу
	protected function time($ts=null){
		return $ts?date('H:i:s', $ts):date('H:i:s');
	}
	
	protected function dayWeekEn($num){
		switch($num){
			case 1:return 'Monday';
			case 2:return 'Tuesday';
			case 3:return 'Wednesday';
			case 4:return 'Thursday';
			case 5:return 'Friday';
			case 6:return 'Saturday';
			case 0:return 'Sunday';
		}
	}
}
?>