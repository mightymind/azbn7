<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >SEO-настройки записи <?=$param['entity']['item']['title'];?></h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/entity_seo/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[entity]',
		'value' => $param['entity']['entity']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Title',
		'html' => ' id="" ',
		'name' => 'item[title]',
		'value' => $param['item']['title'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Description',
		'html' => ' id="" ',
		'name' => 'item[description]',
		'value' => $param['item']['description'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Keywords',
		'html' => ' id="" ',
		'name' => 'item[keywords]',
		'value' => $param['item']['keywords'],
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