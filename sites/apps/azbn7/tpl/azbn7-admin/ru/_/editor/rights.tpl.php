<?
// виджет

$rights = $this->Azbn7->mdl('DB')->read('right', '1 ORDER BY uid');

if(count($rights)) {
?>

<div class=" <? if($this->Azbn7->mdl('Session')->hasRight('user', 'site.admin.right.update')) {} else { echo 'azbn7-hidden'; } ?> " >

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
