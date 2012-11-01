<table class="table table-striped table_plan">
	<tr><td></td>
		<td>
			<form style="margin:0" id="add">
				<?=CHtml::textArea('text','',array('form'=>'add', 'rows'=>2, 'class'=>'span6'))?>
			</form></td>
		<td width="70">
			<input id="user_0" type="radio" form="add" name="user" value="a" style="float:left; margin:7px;" /><label for="user_0" style="margin:5px;">А</label>
			<input id="user_1" type="radio" form="add" name="user" value="h" style="float:left; margin:7px;" /><label for="user_1" style="margin:10px;">Хэ</label></td>
		<td style="text-align:center;">
			<button class="btn btn-small btn-inverse"><i class="icon-plus icon-white"></i> добавить</button></td></tr>
<?foreach($data as $row){?>
	<tr><td style="width:20px; text-align:center;"><?=$row->id?></td>
		<td><?=$row->text?></td>
		<td style="text-align:center;"><? switch($row->user){case 'a':echo 'А';break;case 'h':echo 'Хэ';}?></td>
		<td style="width:100px; text-align:center;" class="center"><form style="margin:0" id="renew_<?=$row->id?>">
			<?=CHtml::hiddenField('id', $row->id, array('form'=>'renew_'.$row->id))?><? switch($row->status){
			case 0:?><button class="btn btn-small btn-danger">нужно</button><?break;
			case 1:?><button class="btn btn-small btn-warning">в процессе</button><?break;
			case 2:?><button class="btn btn-small btn-success disabled">сделано</button><?break;
			}?></form></td></tr>
<? }?>
</table>