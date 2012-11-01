<tr>
	<td>
		<a data-toggle="modal" href="#myModal" class="article-delete">
			<i class="icon-trash"></i>
		</a>
	</td>
	<td><?=$model->id?></td>
	<td><?=$model->full_name?></td>
	<td><?=$model->identity?></td>
	<td><?=$model->network?></td>
	<td><?=$model->role?></td>
	<td>
		<a href="/admin/user/update/<?=$model->id?>">
			<i class="icon-pencil"></i>
		</a>
	</td>
</tr>