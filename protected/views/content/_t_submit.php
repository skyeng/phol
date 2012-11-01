		<div class="form-actions">
			<button class="btn btn-primary" type="button">Сохранить и добавить ещё задание</button>
			<button class="btn btn-success" type="button">Сохранить и закончить</button>
			<script type="text/javascript">
			jQuery(function($) {
				$('body').off('click','.btn-primary');
				$('body').on('click','.btn-primary',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/tBodyNext',
					'cache':false,
					'data':$('.form-horizontal').serialize(),
					'success':function(html){$('.control-group').remove(); $('.form-actions').replaceWith(html)}
				});return false;});
				$('body').off('click','.btn-success');
				$('body').on('click','.btn-success',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/tBody',
					'cache':false,
					'data':$('.form-horizontal').serialize(),
					'success':function(html){$('.control-group').remove(); $('.form-actions').replaceWith(html)}
				});return false;});
				$('body').off('click','.add_ans');
				$('body').on('click','.add_ans',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/addAns',
					'cache':false,
					'data':{'data':next_ans_num,'qw':next_qw_num-1},
					'success':function(html){$('.add_ans:last').before(html)}
				});return false;});
				$('body').off('click','.add_qw');
				$('body').on('click','.add_qw',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/addQw',
					'cache':false,
					'data':{'data':next_qw_num},
					'success':function(html){$('.add_ans').remove(); $('.add_qw_group').before(html)}
				});return false;});
			});
			</script>
		</div>