<?
// виджет

$rights = $this->Azbn7->mdl('DB')->read('right', '1 ORDER BY uid');

if(count($rights)) {
?>

<div class="azbn-rights-list <? if($this->Azbn7->mdl('Session')->hasRight('user', 'site.' . $param['type'] . '.item.right.access')) {} else { echo 'azbn7-hidden'; } ?> " >

	<div class="mass-btns float-sm-right" >
		<a class="check-btn btn btn-sm btn-success" data-check-all="1" href="#checkall" >Все</a>
		/
		<a class="check-btn btn btn-sm btn-warning" data-check-all="0" href="#uncheckall" >Ничего</a>
	</div>

<?
	foreach($rights as $row) {
?>

<div class="form-group " >
	<label><input type="checkbox" class="right-item-cb" name="item[right][<?=$row['uid'];?>]" value='1' <?if(isset($param['item']['right'][$row['uid']])) { echo 'checked';}?> /> <?=$row['title'];?></label>
</div>

<?
	}
?>

</div>

<?
}
