<form id="uploadForm" class="form-horizontal" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Новое задание</legend>
		<div class="control-group">
			<label class="control-label" for="input01">Тип задания:</label>
			<div class="controls">
				<select name="question_type" id="input01">
					<option></option>
					<option value="1">Audio/Video</option>
					<option value="2">Text</option>
					<option value="3">Picture</option>
					<option value="4">Grammar</option>
					<option value="5">Vocabulary</option>
				</select>
			</div>
		</div>
		<? $this->renderPartial('_submit');?>
	</fieldset>
</form>
