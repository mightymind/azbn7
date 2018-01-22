<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<h2 class="mt-2 mb-1" >Создание состояния</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/state/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Название (пояснение)',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Уникальный ID',
		'html' => ' id="" ',
		'name' => 'item[uid]',
		'value' => $this->Azbn7->randstr(16),
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
		'value' => $this->Azbn7->randstr(16),
		'hierarchy' => $state_h,
		'start_index' => 0,
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