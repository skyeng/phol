		<div class="form-actions">
			<button class="btn btn-primary" type="button">Дальше</button>
			<script type="text/javascript">
			jQuery(function($) {
				$('body').off('click','.btn-primary');
				$('body').on('click','.btn-primary',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/qType',
					'cache':false,
					'data':$('.form-horizontal').serialize(),
					'success':function(html){$('.form-actions').replaceWith(html)}
				});return false;});
			});
			</script>
		</div>