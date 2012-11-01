<h1>Заказы на пробные уроки SkyEng</h1>
<br />
<table class="table-condensed table-striped">
	<thead>
	<tr>
		<th>ID</th>
		<th>name</th>
		<th>email</th>
		<th>phone</th>
		<th>datetime (MSK)</th>
	</tr>
	</thead>
	<tbody>
	<? foreach($data as $model){?>
		<tr>
			<td><?=$model->id?></td>
			<td><?=$model->name?></td>
			<td><?=$model->email?></td>
			<td><?=$model->phone?></td>
			<td><?=$model->datetime?></td>
		</tr>
	<? }?>
	</tbody>
</table>