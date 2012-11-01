		<div class="control-group" style="border-top:1px solid #DDDDDD; padding-top:18px;">
			<label class="control-label" for="input11_<?=$data?>">Вопрос:</label>
			<div class="controls">
				<input type="text" class="input-large" name="t_question_<?=$data?>" id="input11_<?=$data?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input12_<?=$data?>_1">Ответы:</label>
			<div class="controls">
				<input type="checkbox" name="t_right_<?=$data?>_1" id="input13_<?=$data?>_1" value="1" />
				<input type="text" class="input-large" name="t_ans_<?=$data?>_1" id="input12_<?=$data?>_1" /><br />
				<input type="checkbox" name="t_right_<?=$data?>_2" id="input13_<?=$data?>_2" value="1" />
				<input type="text" class="input-large" name="t_ans_<?=$data?>_2" id="input12_<?=$data?>_2" />
				<script type="text/javascript">var next_qw_num=<?=$data+1?>; var next_ans_num=3;</script>
				<button class="btn add_ans"><i class="icon-plus"></i>Ещё ответ</button>
			</div>
		</div>