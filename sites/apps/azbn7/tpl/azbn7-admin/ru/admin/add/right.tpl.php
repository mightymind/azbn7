<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Создание права</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/right/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Название',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[uid]',
		'value' => 'site.user.sysopt',
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