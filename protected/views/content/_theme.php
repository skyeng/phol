				<br />
				<select name="theme<?=$data?>" id="input05_<?=$data?>">
					<option></option>
					<? foreach($topics as $topic){
					?><option value="<?=$topic->id?>"><?=$topic->name?></option>
					<? }?>
				</select>
				<script type="text/javascript">next_num=<?=$data+1?>;</script>