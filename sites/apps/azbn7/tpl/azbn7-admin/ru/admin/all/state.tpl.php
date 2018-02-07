<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >
	Состояния
	
	<div class="float-sm-right item-base-functions" >
		<a href="<?=$this->Azbn7->mdl('Site')->url('/admin/add/state/');?>" ><i class="fa fa-plus-circle" aria-hidden="true" title="Создать запись" ></i></a>
	</div>
	
</h2>


<?
$state = $this->Azbn7->mdl('DB')->read('state');
$state_h = $this->Azbn7->mdl('Site')->buildHierarchy($state);

$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/list_state', array(
	'html' => 'class="list-entity-type " id="" ',
	'hierarchy' => $state_h,
	'start_index' => 0,
	'hide_zero' => 1,
));
?>