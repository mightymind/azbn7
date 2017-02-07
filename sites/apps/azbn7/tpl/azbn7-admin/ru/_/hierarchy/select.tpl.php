<?
// footer сайта

/*
$param = array(
	'html' => 'class="" id=""',
	'hierarchy' => array(
		'items' => array(),
		'tree' => array(),
	),
	'start_index' => 0,
)
*/

//$func_name = 'showItemWithChildren_' . $tpl_uid;

$func = function(&$catalog, $item_id, $tab = "&nbsp; ") use (&$func) {
	?>
	<option value="<?=$catalog['items'][$item_id]['id'];?>" data-uid="<?=$catalog['items'][$item_id]['uid'];?>" ><?=$tab.$catalog['items'][$item_id]['title'];?></option>
	<?
	if(isset($catalog['tree'][$item_id])) {
		if(count($catalog['tree'][$item_id])) {
			foreach($catalog['tree'][$item_id] as $k => $v) {
				?>
				<?
				$func($catalog, $k, $tab.'- ');
				?>
				<?
			}
		}
	}
};

if(count($param['hierarchy']) && count($param['hierarchy']['items'])) {
	?>
	
<div class="form-group " <?=$param['html'];?> >
	
	<?
	if(isset($param['title'])) {
	?>
	<label><?=$param['title'];?></label>
	<?
	}
	?>
	
	<select class="form-control" name="<?=isset($param['name']) ? $param['name'] : '';?>" data-select-value="<?=isset($param['value']) ? $param['value'] : '';?>" >
		<?
		$param['hide_zero'] = isset($param['hide_zero']) ? $param['hide_zero'] : 0;
		if($param['hide_zero']) {
			
		} else {
		?>
		<option value="0" data-uid="" >Без родителя</option>
		<?
		}
		?>
	<?
	if(count($param['hierarchy']['tree'][$param['start_index']])) {
		foreach($param['hierarchy']['tree'][$param['start_index']] as $k => $v) {
			$func($param['hierarchy'], $k);
		}
	}
	?>
	</select>
</div>
	
	<?
}

?>