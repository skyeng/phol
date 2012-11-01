		<div class="control-group" style="border-top:1px solid #DDDDDD; padding-top:18px;">
			<label class="control-label" for="input02">Название:</label>
			<div class="controls">
				<input type="text" class="input-large" name="title" id="input02" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input03">Заголовок (текст в начале):</label>
			<div class="controls">
				<textarea id="textarea" class="input-xlarge" rows="3" name="pre_text" id="input03"></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input04">Данные по источнику:</label>
			<div class="controls">
				<input type="text" class="input-large" name="source" id="input04" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input05_1">Темы:</label>
			<div class="controls">
				<select name="theme1" id="input05_1">
					<option></option>
					<? foreach($topics as $topic){
					?><option value="<?=$topic->id?>"><?=$topic->name?></option>
					<? }?>
				</select>
				<script type="text/javascript">var next_num=2;</script>
				<button class="btn add_theme"><i class="icon-plus"></i></button>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="input06">Уровень сложности:</label>
			<div class="controls">
				<input type="text" class="input-large" name="level" id="input06" />
			</div>
		</div>