<h1>Блоки и ресурсы</h1><br />
<h3><?=$view->block?> : <?=$view->scenario?></h3><br />
<div class="row">
	<div class="span6">
		View: <? if($view->block=='layout' || $view->block=='view'){?>это зависимости для layout, вида нет<?
			}else{?><span id="old"><?=$html?></span>.php&nbsp;&nbsp;<i class="icon-pencil view_mod"></i><? }?>
	</div>
</div>
<br />
<div class="row">
	<div class="span5">
		<h3>styles</h3>
		<form id="add">
		<table class="table table-striped">
		<? foreach($css as $dep)
			$this->renderPartial('_row_depend',array('dep'=>$dep));?>
			<tr id="last"><td style="vertical-align:middle;"><input type="text" name="link" style="margin:0;" /></td>
				<td width="200"><dl class="dl-horizontal" style="margin:0;">
					<dt style="float:left;"><input id="location_0" type="radio" name="location" value="0" style="margin-right:5px;" /></dt>
					<dd><label for="location_0" style="margin:0px;">local</label></dd><div class="clear"></div>
					<dt style="float:left;"><input id="location_1" type="radio" name="location" value="1" style="margin-right:5px;" /></dt>
					<dd><label for="location_1" style="margin:0px;">global</label></dd><div class="clear"></div>
					<dt style="float:left;"><input id="location_2" type="radio" name="location" value="2" style="margin-right:5px;" /></dt>
					<dd><label for="location_2" style="margin:0px;">external</label></dd><div class="clear"></div>
					</dl></td>
				<td style="vertical-align:middle;"><i class="icon-plus add_css"></i></td></tr>
		</table>
		</form>
	</div>
	<div class="span5 offset1">
		<h3>scripts</h3>
		<form id="add2">
		<table class="table table-striped">
		<? foreach($js as $dep)
			$this->renderPartial('_row_depend',array('dep'=>$dep));?>
			<tr id="last2"><td style="vertical-align:middle;"><input type="text" name="link" style="margin:0;" /></td>
				<td width="200"><dl class="dl-horizontal" style="margin:0;">
					<dt style="float:left;"><input id="location2_0" type="radio" name="location" value="0" style="margin-right:5px;" /></dt>
					<dd><label for="location2_0" style="margin:0px;">local</label></dd><div class="clear"></div>
					<dt style="float:left;"><input id="location2_1" type="radio" name="location" value="1" style="margin-right:5px;" /></dt>
					<dd><label for="location2_1" style="margin:0px;">global</label></dd><div class="clear"></div>
					<dt style="float:left;"><input id="location2_2" type="radio" name="location" value="2" style="margin-right:5px;" /></dt>
					<dd><label for="location2_2" style="margin:0px;">external</label></dd><div class="clear"></div>
					</dl></td>
				<td style="vertical-align:middle;"><i class="icon-plus add_js"></i></td></tr>
		</table>
		</form>
	</div>
</div>
<br />
<dl class="dl-horizontal">
	<dt>local:</dt>
	<dd>используется только для данного block:scenario<br />
		указывается путь от /css/ (или /js/)</dd><br />
	<dt>gobal:</dt>
	<dd>может использоваться в нескольких block:scenario<br />
		указывается путь от /css/ (или /js/)<br />
		при подключении проверяется, повторное включение отсеивается</dd><br />
	<dt>external:</dt>
	<dd>может использоваться в нескольких block:scenario<br />
		указывается адрес вместе с протоколом (http[s]://)<br />
		при подключении проверяется, повторное включение отсеивается</dd>
<dl>
<script type="text/javascript">
jQuery(function($){
	$('body').on('click','.view_mod',function(){
		$(this).parent().html('View: <input type="text" id="new_view" value="'+$('#old').html()+'" />.php&nbsp;&nbsp;<i class="icon-ok view_save"></i>');	
	});
	$('body').on('click','.view_save',function(){
		jQuery.ajax({
			'type':'POST',
			'url':'/admin/site/blockNewView',
			'cache':false,
			'data':{'new':$('#new_view').val(),'id':'<?=$view->id?>'},
			'success':function(data){$('#new_view').parent().html('View: <span id="old">'+data+'</span>.php&nbsp;&nbsp;<i class="icon-pencil view_mod"></i>');}
		});	
	});
	$('body').on('click','.icon-trash',function(){
		jQuery.ajax({
			'type':'POST',
			'url':'/admin/site/blockDepDelete',
			'cache':false,
			'data':{'id':$(this).prev().val()},
			'success':function(data){$('#dep_'+data).parent().parent().remove();}
		});	
	});
	$('body').on('click','.add_css',function(){
		jQuery.ajax({
			'type':'POST',
			'url':'/admin/site/blockDepAdd',
			'cache':false,
			'data':$('#add').serialize()+'&view_id=<?=$view->id?>&type=css',
			'success':function(data){
				$('#last').before(data);
				$('#last input')[0].value='';
				$('#location_0,#location_1,#location_2').removeAttr('checked');
			}
		});	
	});
	$('body').on('click','.add_js',function(){
		jQuery.ajax({
			'type':'POST',
			'url':'/admin/site/blockDepAdd',
			'cache':false,
			'data':$('#add2').serialize()+'&view_id=<?=$view->id?>&type=js',
			'success':function(data){
				$('#last2').before(data);
				$('#last2 input')[0].value='';
				$('#location2_0,#location2_1,#location2_2').removeAttr('checked');
			}
		});	
	});
});
</script>