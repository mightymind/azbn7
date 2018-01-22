<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<h2 class="mt-2 mb-1" >Редактирование состояния</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/state/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Название (пояснение)',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => $param['item']['title'],
		//'path' => 'entity',
	));
	?>

	<?
	$state = $this->Azbn7->mdl('DB')->read('state');
	$state_h = $this->Azbn7->mdl('Site')->buildHierarchy($state);

	$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/select', array(
		'title' => 'Родитель',
		'html' => ' id="" ',
		'name' => 'item[parent]',
		'value' => $param['item']['parent'],
		'hierarchy' => $state_h,
		'start_index' => 0,
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/submit', array(
		'title' => 'Обновить',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>