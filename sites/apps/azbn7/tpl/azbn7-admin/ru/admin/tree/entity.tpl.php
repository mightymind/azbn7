<?
// Административный шаблон

$user_arr = array();

$users = $this->Azbn7->mdl('DB')->read('user');
if(count($users)) {
	foreach($users as $u) {
		$user_arr[$u['id']] = $u;
	}
}

?>

<h2 class="mt-2 mb-1" >
	<?=$param['type']['title'];?>. Записи. В виде дерева
	
	<div class="float-sm-right item-base-functions" >
		
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $param['type']['id']);?>" title="В виде списка" ><i class="fa fa-list" aria-hidden="true"></i></a>
		
		<?
		if($param['type']['fill']) {
		?>
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity/?type=' . $param['type']['id']);?>" title="Создать запись" ><i class="fa fa-plus-circle" aria-hidden="true" ></i></a>
		<?
		}
		?>
		
	</div>
	
</h2>

<?

if(count($param['items'])) {
	
	$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($param['items']);
	
	$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/list_entity', array(
		//'html' => ,
		'hierarchy' => $entity_type_h,
		'start_index' => 0,
		'hide_zero' => 1,
	));
	
}

?>