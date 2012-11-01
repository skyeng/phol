			<tr><td><?=$dep->link?></td>
				<td><? if($dep->location)
				if($dep->location == 2)
					echo ' (external)';
				else
					echo ' (global)';?></td>
				<td><input type="hidden" id="dep_<?=$dep->id?>" name="dep_<?=$dep->id?>" value="<?=$dep->id?>" /><i class="icon-trash"></i></td></tr>