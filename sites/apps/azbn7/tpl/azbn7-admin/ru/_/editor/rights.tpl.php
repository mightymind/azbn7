<?
// виджет

$rights = $this->Azbn7->mdl('DB')->read('right', '1 ORDER BY uid');

if(count($rights)) {
?>

<div class=" <? if($this->Azbn7->mdl('Session')->hasRight('user', 'site.' . $param['type'] . '.item.right.access')) {} else { echo 'azbn7-hidden'; } ?> " >

	<div class="" >
		<a href="#checkall" >Отменить все</a>
		/
		<a href="#uncheckall" >Снять отметки</a>
	</div>

<?
	foreach($rights as $row) {
?>

<div class="form-group " >
	<label><input type="checkbox" name="item[right][<?=$row['uid'];?>]" value="1" <?if($param['item']['right'][$row['uid']]) { echo 'checked';}?> /> <?=$row['title'];?></label>
</div>

<?
	}
?>

</div>

<?
}
