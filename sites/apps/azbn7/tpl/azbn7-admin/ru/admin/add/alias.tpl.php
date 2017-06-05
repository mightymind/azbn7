<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Создание синонима</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/alias/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Название синонима',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/pos', array(
		'title' => 'Позиция элемента в общем списке',
		'html' => ' id="" ',
		'name' => 'item[pos]',
		'value' => $this->Azbn7->config['mysql'][0]['max_value']['js_int'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/visible', array(
		'title' => 'Использовать в работе',
		'html' => ' id="" ',
		'name' => 'item[visible]',
		'value' => '10',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Искать в строке адреса (виртуальный адрес)',
		'html' => ' id="" ',
		'name' => 'item[find]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Заменить в строке адреса на (реальный адрес)',
		'html' => ' id="" ',
		'name' => 'item[set]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/submit', array(
		'title' => 'Создать',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>