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

$func = function(&$catalog, $item_id, $tab = '') use (&$func) {//$tab = "&nbsp; "
	?>
	<li value="<?=$catalog['items'][$item_id]['id'];?>" data-uid="<?=$catalog['items'][$item_id]['uid'];?>" >
		<div class="float-sm-right entity-type__list-item" >
			
			<?
			if($catalog['items'][$item_id]['fill']) {
			?>
			<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $catalog['items'][$item_id]['id']);?>" title="Добавить запись данного типа" ><i class="fa fa-plus" aria-hidden="true"></i></a>
			<?
			}
			?>
			
			<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity_type/' . $catalog['items'][$item_id]['id'] . '/');?>" title="Редактировать настройки типа" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
		</div>
		<?=$tab.$catalog['items'][$item_id]['title'];?>
	<?
	if(count($catalog['tree'][$item_id])) {
		?>
		<ul >
		<?
		foreach($catalog['tree'][$item_id] as $k => $v) {
			?>
			<?
			$func($catalog, $k, '');//$tab.'- '
			?>
			<?
		}
		?>
		</ul>
		<?
	}
	?>
	</li>
	<?
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