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
	<li value="<?=$catalog['items'][$item_id]['id'];?>" data-uid="<?=$catalog['items'][$item_id]['uid'];?>" ><?=$tab.$catalog['items'][$item_id]['title'];?></li>
	<?
	if(count($catalog['tree'][$item_id])) {
		foreach($catalog['tree'][$item_id] as $k => $v) {
			?>
			<?
			$func($catalog, $k, $tab.'- ');
			?>
			<?
		}
	}
};

if(count($param['hierarchy']) && count($param['hierarchy']['items'])) {
	?>
	<ul <?=$param['html'];?> >
	<?
	if(count($param['hierarchy']['tree'][$param['start_index']])) {
		foreach($param['hierarchy']['tree'][$param['start_index']] as $k => $v) {
			$func($param['hierarchy'], $k);
		}
	}
	?>
	</ul>
	<?
}

?>