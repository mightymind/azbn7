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
	
	$entity = $this->Azbn7->mdl('Entity')->item($catalog['items'][$item_id]['id']);
	
	?>
	<li value="<?=$catalog['items'][$item_id]['id'];?>" data-uid="<?=$catalog['items'][$item_id]['uid'];?>" >
		<div class="float-xs-right entity-type__list-item" >
			<?
			if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.not_author.update') || $this->Azbn7->mdl('Site')->is('user') == $entity['entity']['user']) {
			?>
			<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $entity['entity']['id'] . '/');?>" title="Редактировать" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
			<?
			}
			?>
		</div>
		<?=$entity['item']['title'];?>
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