<h1>Что сделать:</h1>
<br />
<?
$this->renderPartial('_plan_table',array(
	'data'=>$data,
));
?>
<script type="text/javascript">
jQuery(function($) {
$('body').on('click','.btn-inverse',function(){jQuery.ajax({'type':'POST','url':'/admin/site/add','cache':false,'data':$('#add').serialize(),'success':function(html){jQuery(".table_plan").replaceWith(html)}});return false;});
$('body').on('click','.btn-danger, .btn-warning',function(){jQuery.ajax({'type':'POST','url':'/admin/site/renew','cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery(".table_plan").replaceWith(html)}});return false;});
});
</script>