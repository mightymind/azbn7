<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Редактирование перенаправления</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/alias/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Название перенаправления',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => $param['item']['title'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/pos', array(
		'title' => 'Позиция элемента в общем списке',
		'html' => ' id="" ',
		'name' => 'item[pos]',
		'value' => $param['item']['pos'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/visible', array(
		'title' => 'Использовать в работе',
		'html' => ' id="" ',
		'name' => 'item[visible]',
		'value' => $param['item']['visible'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Искать в строке адреса (виртуальный адрес)',
		'html' => ' id="" ',
		'name' => 'item[find]',
		'value' => $param['item']['find'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Pfvtyznm в строке адреса на (реальный адрес)',
		'html' => ' id="" ',
		'name' => 'item[set]',
		'value' => $param['item']['set'],
		//'path' => 'entity',
	));
	?>
	
	<button type="submit" class="btn btn-primary">Обновить</button>
	
</form>