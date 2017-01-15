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
	<li data-entity-id="<?=$entity['entity']['id'];?>" data-entity-pos="<?=$entity['entity']['pos'];?>" >
		
		<input type="checkbox" class="azbn-entity-all-mass-cb" value="<?=$entity['entity']['id'];?>" />
		<span class="drag-handle" ><i class="fa fa-arrows onhover-opacity" aria-hidden="true"></i> <?=$entity['item']['title'];?></span>
		
		<ul class="hierarchy-draggable " data-uniq="<?=$this->Azbn7->randstr(16);?>" >
		<?
		if(count($catalog['tree'][$item_id])) {
			foreach($catalog['tree'][$item_id] as $k => $v) {
				?>
				<?
				$func($catalog, $k, '');//$tab.'- '
				?>
				<?
			}
		}
		?>
		</ul>
		
	</li>
	<?
};

if(count($param['hierarchy']) && count($param['hierarchy']['items'])) {
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/mass-select', $param);
	?>
	
	<hr />
	
	<ul class="list-entity-type hierarchy-draggable" data-uniq="<?=$this->Azbn7->randstr(16);?>" >
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