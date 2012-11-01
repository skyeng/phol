<?
$num=1;
$result = $question->text;
$words = array();
do{
	$source = $result;
	if(preg_match('/input\(\'([\s\S]*?)\'\)/', $source, $match)){
		$arr = preg_split('/\'\|\|\'/', $match[1]);
		$words[] = array(0=>$num,1=>$arr[0]);
		
		$pattern = '/input\(';
		$replacement = '<span id ="_drop'.$num.'" class="question__drug-and-drop__droppable-element" data-q_offset="'.$num.'"';
		foreach($arr as $i=>$word){
			if($i==0)
				$pattern .= '\''.$word.'\'';
			else
				$pattern .= '\|\|\''.$word.'\'';
			$replacement .= ' data-value_'.$i.'="'.$word.'"';
		}
		$pattern .= '\)/';
		$replacement .= '></span>';
		
		$result = preg_replace($pattern, $replacement, $source, 1);
	}
	$num++;
}while($result != $source);
?>
<div class="question__drug-and-drop" id="question__drug-and-drop">
	<div id="dragObjects" class="question__drug-and-drop__draggable-elements__holder">
		<?
		$drags = '';
		shuffle($words);
		foreach($words as $w)
			$drags .= '<div id="drop'.$w[0].'" class="question__drug-and-drop__draggable-element__holder">
				<div id ="word'.$w[0].'" class="question__drug-and-drop__draggable-element">'.$w[1].'</div>
			</div>';
		echo $drags;
		?>
		<div style="clear:left;"></div>
	</div>
	<div id="dropObjects" class="question__drug-and-drop__droppable-elements__holder">
		<?=$result?>
	</div>
</div>