<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >
	Типы данных
	
	<div class="float-sm-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/entity_type/');?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	
</h2>


<?
$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/list_entity_type', array(
	'html' => 'class="list-entity-type " id="" ',
	'hierarchy' => $entity_type_h,
	'start_index' => 0,
	'hide_zero' => 1,
));
?>