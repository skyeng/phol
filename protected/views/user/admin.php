<h1>Управление пользователями</h1>
<br />
<table class="table-condensed table-striped">
	<thead>
	<tr>
		<th></th>
		<th>ID</th>
		<th>full_name</th>
		<th>identity</th>
		<th>network</th>
		<th>role</th>
	</tr>
	</thead>
	<tbody>
	<?
	$models = User::model()->findAll(array('order'=>'id DESC'));
	foreach($models as $model)
		$this->renderPartial('_table-element', array('model'=>$model));
	?>
	</tbody>
</table>

<script>
	$(document).ready(function(){
		var $id;
		var $line;
		$('#myModal').hide();
		$('a.article-delete').click(function(){
			$line 	= $(this).parent().parent();
			$id 	= $(this).parent().next().text();
			$('#myModal strong.number').html($id);
			$('#myModal span.name').html($(this).parent().next().next().html());
		});
		$('a.btn-danger').click(function(){
			$.post('/admin/user/delete/'+$id+'?ajax=1', null, function(data) {
				console.log(data);
			});
			$line.hide();
			$('#myModal').modal('hide');
			return false;
		});
	});
</script>

<div class="modal" id="myModal">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Внимание!</h3>
	</div>
	<div class="modal-body">
		<p>Вы уверены, что хотите удалить пользователя № <strong class="number"></strong> <span class="name"></span>?</p>
	</div>
	<div class="modal-footer">
		<a href="" class="btn btn-danger">Удалить</a>
		<a href="#myModal" class="btn" data-dismiss="modal">Нет, я передумал</a>
	</div>
</div>