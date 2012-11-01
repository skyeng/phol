		<div class="form-actions" style="height:30px;">
			<button class="btn btn-primary" type="button" style="margin-right:30px; float:left;">Дальше, к заданиям</button>
			<div class="progress progress-striped active progress-inverse" style="width:250px; border:1px solid #666; margin-top:3px; display:none;">
				<div class="bar" style="width: 0%;"></div>
			</div>
			<script type="text/javascript">
			jQuery(function($) {
				$('body').off('click','.btn-primary');
				$('body').on('click','.btn-primary',function(){$('#uploadForm').ajaxSubmit({
					'type':'POST',
					'url':'/content/qBody',
					'cache':false,
					'beforeSubmit':function(){$('body').off('click','.btn-primary'); $('.progress')[0].style.display = 'inline-block';},
					'uploadProgress':function(a, b, c, d){$('.bar')[0].style.width = d+'%';},
					'success':function(html){$('.control-group').remove();$('.form-actions').replaceWith(html)}
				});return false;});
				$('body').on('click','.add_theme',function(){jQuery.ajax({
					'type':'POST',
					'url':'/content/addTheme',
					'cache':false,
					'data':{'data':next_num},
					'success':function(html){$('.add_theme').before(html)}
				});return false;});
			});
			</script>
		</div>