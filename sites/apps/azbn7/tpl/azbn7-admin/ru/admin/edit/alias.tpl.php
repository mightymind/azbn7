<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Настройки администратора</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/user/');?>" method="POST" >
	
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
		'title' => 'Логин',
		'html' => ' id="" ',
		'name' => 'item[login]',
		'value' => $param['item']['login'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/email', array(
		'title' => 'Email',
		'html' => ' id="" ',
		'name' => 'item[email]',
		'value' => $param['item']['email'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/pos', array(
		'title' => 'Позиция элемента в общем списке',
		'html' => ' id="" ',
		'name' => 'item[pos]',
		'value' => $param['item']['pos'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/visible', array(
		'title' => 'Использовать в работе',
		'html' => ' id="" ',
		'name' => 'item[visible]',
		'value' => $param['item']['visible'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Искать в строке адреса (виртуальный адрес)',
		'html' => ' id="" ',
		'name' => 'item[find]',
		'value' => $param['item']['find'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Pfvtyznm в строке адреса на (реальный адрес)',
		'html' => ' id="" ',
		'name' => 'item[set]',
		'value' => $param['item']['set'],
		//'path' => 'entity',
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