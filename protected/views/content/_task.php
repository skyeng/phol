		<div class="control-group">
			<label class="control-label" for="input10">Тип:</label>
			<div class="controls">
				<select name="t_type" id="input10">
					<option value="0">без форматирования</option>
					<option value="1">test</option>
					<option value="2">writing</option>
					<option value="3">drag&amp;drop</option>
				</select>
			</div>
			<input type="hidden" name="q_id" value="<?=$q_id?>" />
		</div>
		<div class="form-actions">
			<button class="btn btn-primary" type="button">Дальше</button>
			<script type="text/javascript">
			jQuery(function($) {
				$('body').off('click','.btn-primary');
				$('body').on('click','.btn-primary',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/tType',
					'cache':false,
					'data':{'data':$('#input10').val()},
					'success':function(html){$('.form-actions').replaceWith(html)}
				});return false;});
			});
			</script>
		</div>