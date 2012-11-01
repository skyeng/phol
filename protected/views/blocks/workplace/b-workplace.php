					<div class="workplace">
						<div class="task__holder">
							<?
							if(!$isTeacher){
								$task->pre_text = preg_replace('/<com>[\s\S]*?<\/com>/', '', $task->pre_text);
								$task->pre_text = preg_replace('/<teacher>[\s\S]*?<\/teacher>/', '', $task->pre_text);
								$task->pre_text = preg_replace('/<explain>[\s\S]*?<\/explain>/', '', $task->pre_text);
							}
								
							switch($task->type){
								case 'G':
									$this->block('task/grammar',array('task'=>$task,'isTeacher'=>$isTeacher));
									break;
								case 'L':
									$this->block('task/listening',array('task'=>$task,'isTeacher'=>$isTeacher));
									break;
								case 'R':
									$this->block('task/reading',array('task'=>$task,'isTeacher'=>$isTeacher));
									break;
								case 'S':
									$this->block('task/speaking',array('task'=>$task,'isTeacher'=>$isTeacher));
									break;
								case 'V':
									$this->block('task/vocabulary',array('task'=>$task,'isTeacher'=>$isTeacher));
									break;
								case 'P':
									$this->block('task/pronunciation',array('task'=>$task,'isTeacher'=>$isTeacher));
									break;
							}
							?>
						</div>
						<div class="question__holder">
							<?
							if(!$isTeacher){
								$question->text = preg_replace('/<com>[\s\S]*?<\/com>/', '', $question->text);
								$question->text = preg_replace('/<teacher>[\s\S]*?<\/teacher>/', '', $question->text);
								$question->text = preg_replace('/<explain>[\s\S]*?<\/explain>/', '', $question->text);
							}
							
							switch($question->type){
								case 0:
									$this->block('question/plain-text',array('question'=>$question,'isTeacher'=>$isTeacher,'isFirst'=>$isFirst));
									break;
								case 1:
									$this->block('question/test',array('question'=>$question,'isTeacher'=>$isTeacher,'isFirst'=>$isFirst));
									break;
								case 2:
									$this->block('question/writing',array('question'=>$question,'isTeacher'=>$isTeacher,'isFirst'=>$isFirst));
									break;
								case 3:
									$this->block('question/drag-and-drop',array('question'=>$question,'isTeacher'=>$isTeacher,'isFirst'=>$isFirst));
									break;
								case 4:
									$this->block('question/order-sentences',array('question'=>$question,'isTeacher'=>$isTeacher,'isFirst'=>$isFirst));
									break;
							}
							?>
						</div>
					</div>