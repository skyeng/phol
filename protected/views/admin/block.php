<h1>Блоки и ресурсы</h1><br />
<table class="table table-striped" style="width:300px;">
	<thead>
	<tr><th>block</th>
		<th colspan="2">scenario</th></tr>
	 </thead>
	<tbody>
<?foreach($blocks as $block){?>
	<tr><td colspan="3"><?=$block->block?></td></tr>
		<? foreach($scenarios[$block->block] as $sc){?>
	<tr><td style="width:20px; text-align:center;">&mdash;</td>
		<td width="200"><?=$sc->scenario?></td>
		<td width="40"><a href="/admin/scenario/<?=$sc->id?>"><i class="icon-arrow-right"></i></a></td></tr>
		<? }?>
<? }?>
	</tbody>
</table>